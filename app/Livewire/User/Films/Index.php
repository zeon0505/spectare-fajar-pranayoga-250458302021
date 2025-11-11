<?php

namespace App\Livewire\User\Films;

use App\Models\Film;
use App\Models\Genre;
use Livewire\Component;

class Index extends Component
{
    public $search = '';
    public $selectedGenre = '';

    public function render()
    {
        $genres = Genre::all();

        $films = Film::when($this->selectedGenre, function ($query) {
                $query->where('genre_id', $this->selectedGenre);
            })
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.user.films.index', compact('films', 'genres'));
    }
}
