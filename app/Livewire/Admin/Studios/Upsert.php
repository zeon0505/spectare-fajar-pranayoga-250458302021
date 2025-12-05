<?php

namespace App\Livewire\Admin\Studios;

use App\Models\Studio;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upsert extends Component
{
    use WithFileUploads;

    public ?Studio $studio = null;
    public string $name = '';
    public string $location = '';
    public int $capacity = 0;
    public $image;
    public ?string $existingImage = null;

    public function mount(Studio $studio = null)
    {
        if ($studio?->exists) {
            $this->studio = $studio;
            $this->name = $studio->name ?? '';
            $this->location = $studio->location ?? '';
            $this->capacity = $studio->capacity ?? 0;
            $this->existingImage = $studio->image;
        }
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|max:2048', // Max 2MB
        ];

        $this->validate($rules);

        // Check if capacity is being reduced and there are future bookings
        if ($this->studio && $this->studio->exists) {
            $oldCapacity = $this->studio->capacity;
            $newCapacity = $this->capacity;
            
            if ($newCapacity < $oldCapacity) {
                // Get all future showtimes for this studio
                $futureBookingsCount = \App\Models\Booking::whereHas('showtime', function ($query) {
                    $query->where('studio_id', $this->studio->id)
                          ->where('date', '>=', now()->toDateString());
                })->count();

                if ($futureBookingsCount > 0) {
                    $this->addError('capacity', 
                        "Cannot reduce capacity. There are {$futureBookingsCount} future booking(s) for this studio. " .
                        "Please wait until those showtimes have passed or cancel the bookings first."
                    );
                    return;
                }
            }
        }

        $data = [
            'name' => $this->name,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'layout' => $this->generateLayout(), // Auto-generate layout based on capacity
        ];

        if ($this->image) {
            if ($this->studio && $this->studio->image) {
                Storage::disk('public')->delete($this->studio->image);
            }
            $data['image'] = $this->image->store('studios', 'public');
        }

        Studio::updateOrCreate(
            ['id' => $this->studio?->id],
            $data
        );

        session()->flash('success', 'Studio saved successfully with optimized seat layout.');

        return redirect()->route('admin.studios.index');
    }

    /**
     * Generate optimal seat layout based on capacity
     */
    private function generateLayout(): array
    {
        $capacity = $this->capacity;
        $layout = [];
        
        // Determine optimal rows/columns
        // Prefer 5-8 seats per row for best viewing experience
        $seatsPerRow = min(10, max(5, (int)sqrt($capacity * 1.5)));
        $rows = (int)ceil($capacity / $seatsPerRow);
        
        $remainingSeats = $capacity;
        
        for ($row = 0; $row < $rows; $row++) {
            $seatsInThisRow = min($seatsPerRow, $remainingSeats);
            
            // Add center aisle for rows with 6+ seats
            if ($seatsInThisRow >= 6) {
                $leftSeats = (int)floor($seatsInThisRow / 2);
                $rightSeats = $seatsInThisRow - $leftSeats;
                $layout[] = str_repeat('S', $leftSeats) . ' ' . str_repeat('S', $rightSeats);
            } else {
                $layout[] = str_repeat('S', $seatsInThisRow);
            }
            
            $remainingSeats -= $seatsInThisRow;
        }
        
        return $layout;
    }

    public function render()
    {
        return view('livewire.admin.studios.upsert');
    }
}
