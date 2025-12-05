<?php

namespace App\Livewire\User\Films;

use App\Models\Film;
use App\Models\Genre;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedGenre = '';
    public $ageRating = 'all'; // all, kids, adults

    protected $updatesQueryString = ['search', 'selectedGenre', 'ageRating'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
        $this->selectedGenre = request()->query('selectedGenre', $this->selectedGenre);
        $this->ageRating = request()->query('ageRating', $this->ageRating);
    }

    public function render()
    {
        $films = Film::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedGenre, function ($query) {
                $query->whereHas('genres', function ($q) {
                    // INI ADALAH PERBAIKAN FINAL DAN DEFINITIF
                    $q->where('genres.id', $this->selectedGenre);
                });
            })
            ->when($this->ageRating === 'kids', function ($query) {
                // Kids: SU (Semua Umur), R13+
                $query->whereIn('age_rating', ['SU', 'R13+']);
            })
            ->when($this->ageRating === 'adults', function ($query) {
                // Adults: D17+, 21+
                $query->whereIn('age_rating', ['D17+', '21+']);
            })
            ->paginate(12);

        return view('livewire.user.films.index', [
            'films' => $films,
            'genres' => Genre::all(),
        ]);
    }
}
