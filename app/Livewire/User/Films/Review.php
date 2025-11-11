<?php

namespace App\Livewire\User\Films;

use Livewire\Component;
use App\Models\Film;
use App\Models\Review as UserReview;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

class Review extends Component
{
    #[Layout('layouts.app')]

    public $film;
    public $rating;
    public $comment;

    public function mount($id)
    {
        $this->film = Film::findOrFail($id);
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'film_id' => $this->film->id,
            'rating'  => $this->rating,
            'comment' => $this->comment,
        ]);

        session()->flash('success', 'Ulasan berhasil dikirim!');
        return redirect()->route('user.films.show', $this->film->id);
    }

    public function render()
    {
        return view('livewire.user.films.review');
    }
}
