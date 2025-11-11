<?php

namespace App\Livewire\User\Films;

use App\Models\Film;
use Livewire\Component;

class Show extends Component
{
    public Film $film;

    public function mount($id)
    {
        $this->film = Film::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.user.films.show');
    }
}
