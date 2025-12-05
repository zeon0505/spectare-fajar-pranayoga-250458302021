<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\SnackOrder;
use App\Models\Review;
use App\Models\Film;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]

class UserDashboard extends Component
{
    public $ageRating = 'all'; // all, kids, adults

    public function cancelBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        
        // Only allow cancellation if booking belongs to user and is not already cancelled
        if ($booking->user_id !== Auth::id()) {
            session()->flash('error', 'Unauthorized action');
            return;
        }

        if ($booking->status === 'cancelled') {
            session()->flash('error', 'Booking already cancelled');
            return;
        }

        // Update booking status to cancelled
        $booking->update(['status' => 'cancelled']);
        
        session()->flash('success', 'Booking cancelled successfully');
        $this->dispatch('booking-cancelled');
    }

    public function cancelSnackOrder($orderId)
    {
        $order = SnackOrder::findOrFail($orderId);
        
        // Only allow cancellation if order belongs to user and is not already cancelled
        if ($order->user_id !== Auth::id()) {
            session()->flash('error', 'Unauthorized action');
            return;
        }

        if ($order->status === 'cancelled') {
            session()->flash('error', 'Order already cancelled');
            return;
        }

        // Update order status to cancelled
        $order->update(['status' => 'cancelled']);
        
        session()->flash('success', 'Snack order cancelled successfully');
        $this->dispatch('order-cancelled');
    }

    public function mount()
    {
        // Age rating can be set via query string if needed
        $this->ageRating = request()->query('ageRating', $this->ageRating);
    }

    public function render()
    {
        $user = Auth::user();
        
        $recentBookings = Booking::where('user_id', $user->id)
            ->with('showtime.film', 'showtime.studio')
            ->latest()
            ->take(5)
            ->get();

        $recentSnackOrders = SnackOrder::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $recentReviews = Review::where('user_id', $user->id)
            ->with('film')
            ->latest()
            ->take(5)
            ->get();

        // Apply age rating filter
        $filmQuery = Film::query()
            ->when($this->ageRating === 'kids', function ($query) {
                $query->whereIn('age_rating', ['SU', 'R13+']);
            })
            ->when($this->ageRating === 'adults', function ($query) {
                $query->whereIn('age_rating', ['D17+', '21+']);
            });

        // Fetch featured films IDs
        $featuredNowShowingIds = \App\Models\FeaturedFilm::nowShowing()->pluck('film_id')->toArray();
        $featuredComingSoonIds = \App\Models\FeaturedFilm::comingSoon()->pluck('film_id')->toArray();

        // Now Showing Logic
        $nowShowingFilms = collect();
        if (!empty($featuredNowShowingIds)) {
            $nowShowingFilms = (clone $filmQuery)
                ->whereIn('id', $featuredNowShowingIds)
                ->get()
                ->sortBy(function ($film) use ($featuredNowShowingIds) {
                    return array_search($film->id, $featuredNowShowingIds);
                });
        }

        // Fallback if no featured films match the filter (e.g. no Kids films featured)
        if ($nowShowingFilms->isEmpty()) {
            $nowShowingFilms = (clone $filmQuery)
                ->where('status', 'Now Playing')
                ->latest()
                ->take(5)
                ->get();
        }

        // Coming Soon Logic
        $comingSoonFilms = collect();
        if (!empty($featuredComingSoonIds)) {
            $comingSoonFilms = (clone $filmQuery)
                ->whereIn('id', $featuredComingSoonIds)
                ->get()
                ->sortBy(function ($film) use ($featuredComingSoonIds) {
                    return array_search($film->id, $featuredComingSoonIds);
                });
        }

        // Fallback if no featured films match the filter
        if ($comingSoonFilms->isEmpty()) {
            $comingSoonFilms = (clone $filmQuery)
                ->where('status', 'Now Playing')
                ->latest()
                ->take(5)
                ->get();
        }

        return view('livewire.user.user-dashboard', [
            'recentBookings' => $recentBookings,
            'recentSnackOrders' => $recentSnackOrders,
            'recentReviews' => $recentReviews,
            'nowShowingFilms' => $nowShowingFilms,
            'comingSoonFilms' => $comingSoonFilms,
        ]);
    }
}
