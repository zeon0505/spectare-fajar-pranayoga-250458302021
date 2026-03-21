<?php

namespace App\Livewire\Film;

use App\Models\Film;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public Film $film;
    public $isInWishlist;

    public $reviews = [];
    public $newReview;
    public $newRating = 5;

    public function mount(Film $film)
    {
        $this->film = $film;
        $this->checkIfInWishlist();
    }

    public function checkIfInWishlist()
    {
        if (Auth::check()) {
            $this->isInWishlist = Wishlist::where('user_id', Auth::id())
                                          ->where('film_id', $this->film->id)
                                          ->exists();
        } else {
            $this->isInWishlist = false;
        }
    }

    public function addReview()
    {
        if (!Auth::check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $this->validate([
            'newReview' => 'required|min:5',
            'newRating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'film_id' => $this->film->id,
            'review' => $this->newReview,
            'rating' => $this->newRating,
            'review_date' => now(),
        ]);

        $this->newReview = '';
        $this->newRating = 5;

        session()->flash('message', 'Ulasan Anda telah berhasil ditambahkan.');
    }

    public function toggleWishlist()
    {
        if (!Auth::check()) {
            return $this->redirect(route('login'), navigate: true);
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
                            ->where('film_id', $this->film->id)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $this->isInWishlist = false;
            session()->flash('message', 'Film telah dihapus dari wishlist.');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'film_id' => $this->film->id,
            ]);
            $this->isInWishlist = true;
            session()->flash('message', 'Film telah ditambahkan ke wishlist.');
        }
    }

    public function render()
    {
        $this->reviews = Review::where('film_id', $this->film->id)
                               ->with('user')
                               ->latest()
                               ->get();

        return view('livewire.film.show');
    }
}
