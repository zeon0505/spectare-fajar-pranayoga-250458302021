<?php

namespace App\Livewire\Admin\Showtimes;

use Livewire\Component;
use App\Models\Showtime;
use App\Models\Film;
use App\Models\Studio;

class Create extends Component
{
    public $film_id, $studio_id, $date, $time, $price;
    public $films, $studios;

    protected $rules = [
        'film_id' => 'required',
        'studio_id' => 'required',
        'date' => 'required|date',
        'time' => 'required',
        'price' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        $this->films = Film::all();
        $this->studios = Studio::all();
    }

    public function store()
    {
        $this->validate();

        Showtime::create([
            'film_id' => $this->film_id,
            'studio_id' => $this->studio_id,
            'date' => $this->date,
            'time' => $this->time,
            'price' => $this->price,
        ]);

        session()->flash('message', 'Showtime created successfully.');
        return redirect()->route('showtimes.index');
    }

    public function render()
    {
        return view('livewire.admin.showtimes.create');
    }
}
