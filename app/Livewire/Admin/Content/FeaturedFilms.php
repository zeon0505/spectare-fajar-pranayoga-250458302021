<?php

namespace App\Livewire\Admin\Content;

use App\Models\FeaturedFilm;
use App\Models\Film;
use Livewire\Component;

class FeaturedFilms extends Component
{
    public $search = '';
    public $section = 'now_showing'; // or 'coming_soon'

    public function addFilm($filmId, $section)
    {
        $count = FeaturedFilm::where('section', $section)->count();
        
        FeaturedFilm::create([
            'film_id' => $filmId,
            'section' => $section,
            'order' => $count + 1,
        ]);

        $this->dispatch('featured-updated');
    }

    public function removeFilm($id)
    {
        FeaturedFilm::find($id)->delete();
        $this->dispatch('featured-updated');
    }

    public function updateOrder($list)
    {
        foreach ($list as $item) {
            FeaturedFilm::where('id', $item['value'])->update(['order' => $item['order']]);
        }
    }

    public function render()
    {
        $nowShowing = FeaturedFilm::with('film')
            ->where('section', 'now_showing')
            ->orderBy('order')
            ->get();

        $comingSoon = FeaturedFilm::with('film')
            ->where('section', 'coming_soon')
            ->orderBy('order')
            ->get();

        $searchResults = [];
        if (strlen($this->search) > 2) {
            $existingIds = FeaturedFilm::pluck('film_id');
            $searchResults = Film::where('title', 'like', '%' . $this->search . '%')
                ->whereNotIn('id', $existingIds)
                ->take(5)
                ->get();
        }

        return view('livewire.admin.content.featured-films', [
            'nowShowing' => $nowShowing,
            'comingSoon' => $comingSoon,
            'searchResults' => $searchResults,
        ]);
    }
}
