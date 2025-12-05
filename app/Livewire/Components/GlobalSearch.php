<?php

namespace App\Livewire\Components;

use App\Models\Film;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $search = '';
    public $searchResults = [];

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->searchResults = [];
            return;
        }

        $this->searchResults = Film::where('title', 'like', '%' . $this->search . '%')
            ->select('id', 'title', 'poster_url', 'release_date')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.components.global-search');
    }
}
