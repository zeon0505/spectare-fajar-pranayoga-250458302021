<?php

namespace App\Livewire\Admin\Showtimes;

use Livewire\Component;
use App\Models\Showtime;
use App\Models\Film;
use App\Models\Studio;

class Edit extends Component
{
    public $showtime_id, $film_id, $studio_id, $date, $time, $price;
    public $films, $studios;

    protected $rules = [
        'film_id' => 'required',
        'studio_id' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'price' => 'required|numeric|min:0',
    ];

    public function mount($id)
    {
        $showtime = Showtime::findOrFail($id);
        $this->showtime_id = $showtime->id;
        $this->film_id = $showtime->film_id;
        $this->studio_id = $showtime->studio_id;
        $this->date = $showtime->date;
        $this->time = $showtime->time;
        $this->price = $showtime->price;

        $this->films = Film::all();
        $this->studios = Studio::all();
    }

    public function update()
    {
        $this->validate();

        $showtime = Showtime::find($this->showtime_id);
        $showtime->update([
            'film_id' => $this->film_id,
            'studio_id' => $this->studio_id,
            'date' => $this->date,
            'time' => $this->time,
            'price' => $this->price,
        ]);

        session()->flash('message', 'Showtime updated successfully.');
        return redirect()->route('showtimes.index');
    }

    public function render()
    {
        return view('livewire.admin.showtimes.edit');
    }
}
