<?php

namespace App\Livewire\Admin\Showtimes;

use App\Models\Showtime;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function delete($showtimeId)
    {
        $showtime = Showtime::findOrFail($showtimeId);
        $showtime->delete();

        session()->flash('success', 'Showtime deleted successfully.');
    }

    public function deleteGroup($ids)
    {
        Showtime::whereIn('id', $ids)->delete();
        session()->flash('success', 'Showtime group deleted successfully.');
    }

    private function groupConsecutiveShowtimes($showtimes)
    {
        $grouped = [];

        foreach ($showtimes as $showtime) {
            // Create unique key for same film, studio, and time
            $key = sprintf(
                '%d-%d-%s',
                $showtime->film_id,
                $showtime->studio_id,
                $showtime->time
            );

            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'showtime' => $showtime,
                    'dates' => [$showtime->date],
                    'ids' => [$showtime->id]
                ];
            } else {
                $grouped[$key]['dates'][] = $showtime->date;
                $grouped[$key]['ids'][] = $showtime->id;
            }
        }

        // Format date ranges for each group
        foreach ($grouped as &$group) {
            $dates = collect($group['dates'])->map(fn($d) => Carbon::parse($d))->sort()->values();
            
            if ($dates->count() === 1) {
                $group['date_display'] = $dates[0]->format('d M Y');
            } else {
                // Check if dates are consecutive
                $isConsecutive = true;
                for ($i = 0; $i < $dates->count() - 1; $i++) {
                    if ($dates[$i]->copy()->addDay()->ne($dates[$i + 1])) {
                        $isConsecutive = false;
                        break;
                    }
                }

                if ($isConsecutive) {
                    // Display as range: "04-06 Dec 2025"
                    $start = $dates->first();
                    $end = $dates->last();
                    
                    if ($start->month === $end->month && $start->year === $end->year) {
                        $group['date_display'] = sprintf(
                            '%s-%s %s %s',
                            $start->format('d'),
                            $end->format('d'),
                            $end->format('M'),
                            $end->format('Y')
                        );
                    } else {
                        $group['date_display'] = sprintf(
                            '%s - %s',
                            $start->format('d M Y'),
                            $end->format('d M Y')
                        );
                    }
                } else {
                    // Display as list: "04, 07, 10 Dec 2025"
                    $formatted = $dates->map(fn($d) => $d->format('d'))->implode(', ');
                    $group['date_display'] = sprintf(
                        '%s %s %s',
                        $formatted,
                        $dates->last()->format('M'),
                        $dates->last()->format('Y')
                    );
                }
            }
        }

        return collect($grouped)->values();
    }

    public function render()
    {
        $showtimes = Showtime::with(['film', 'studio'])
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        $groupedShowtimes = $this->groupConsecutiveShowtimes($showtimes);

        return view('livewire.admin.showtimes.index', [
            'groupedShowtimes' => $groupedShowtimes,
        ]);
    }
}
