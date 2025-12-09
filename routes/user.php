<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Livewire\User;
use App\Livewire\User\Studios\Index as UserStudiosIndex;
use App\Livewire\User\Studios\Show as UserStudiosShow;
use App\Livewire\User\Transactions\Detail as UserTransactionsDetail;
use App\Livewire\User\Transactions\Index as UserTransactionsIndex;
use App\Livewire\User\Wishlist\Index as UserWishlistIndex;
use App\Livewire\User\Bookings\Create as UserBookingsCreate;
use App\Livewire\User\Bookings\Detail as UserBookingsDetail;
use App\Livewire\User\Bookings\Index as UserBookingsIndex;
use App\Livewire\User\Bookings\SeatSelection as UserBookingsSeatSelection;
use App\Livewire\User\Bookings\Payment as UserBookingsPayment;
use App\Livewire\User\Profile;
use App\Livewire\Features\Settings;


Route::middleware(['auth', RoleMiddleware::class . ':user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', User\UserDashboard::class)->name('dashboard');

    // 🎬 Films
    Route::get('films', User\Films\Index::class)->name('films.index');
    Route::get('films/{film}', User\Films\Show::class)->name('films.show');

    // 🕒 Showtimes
    Route::get('showtimes', User\Showtimes\Index::class)->name('showtimes.index');
    Route::get('showtimes/{id}', User\Showtimes\Show::class)->name('showtimes.show');

    // 🎞️ Studios
    Route::get('studios', User\Studios\Index::class)->name('studios.index');
    Route::get('studios/{studio}', User\Studios\Show::class)->name('studios.show');

    // 🍿 Snacks (Pembelian makanan & minuman)
    Route::get('snacks', User\Snacks\Index::class)->name('snacks.index');
    Route::get('checkout', User\Snacks\Checkout::class)->name('snacks.checkout');
    Route::get('cart', User\Snacks\ShoppingCart::class)->name('cart.index');

    // 💳 Transactions
    Route::get('transactions', User\Transactions\Index::class)->name('transactions.index');
    Route::get('transactions/{id}', User\Transactions\Detail::class)->name('transactions.detail');

    // ⭐ Reviews
    Route::get('reviews', User\Reviews\Index::class)->name('reviews.index');
    Route::get('reviews/{id}', User\Reviews\Show::class)->name('reviews.show');

    // 🎟️ Bookings
    Route::get('/bookings', User\Bookings\Index::class)->name('bookings.index');
    Route::get('/bookings/create/{showtime}', User\Bookings\Create::class)->name('bookings.create');
    Route::get('/bookings/seat-selection', User\Bookings\SeatSelection::class)->name('bookings.seat-selection');
    Route::get('/bookings/{booking}', User\Bookings\Detail::class)->name('bookings.detail');

    // ❤️ Wishlist
    Route::get('/wishlist', User\Wishlist\Index::class)->name('wishlist.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('profile', User\Profile::class)->name('profile'); // Ubah baris ini
    Route::get('settings', Settings::class)->name('settings');
});
