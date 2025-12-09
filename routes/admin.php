<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Livewire\Admin;

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', Admin\Dashboard::class)->name('dashboard');

    // 🎬 Films
    Route::get('/films', Admin\Films\Index::class)->name('films.index');
    Route::get('/films/create', Admin\Films\Upsert::class)->name('films.create');
    Route::get('/films/{film}/edit', Admin\Films\Upsert::class)->name('films.edit');

    // 🏷️ Genres
    Route::get('/genres', Admin\Genres\Index::class)->name('genres.index');
    Route::get('/genres/create', Admin\Genres\Create::class)->name('genres.create');
    Route::get('/genres/{id}/edit', Admin\Genres\Edit::class)->name('genres.edit');

    // 🎞️ Studios
    Route::get('/studios', Admin\Studios\Index::class)->name('studios.index');
    Route::get('/studios/create', Admin\Studios\Create::class)->name('studios.create');
    Route::get('/studios/{studio}/edit', Admin\Studios\Upsert::class)->name('studios.edit');

    // 🕒 Showtimes
    Route::get('/showtimes', Admin\Showtimes\Index::class)->name('showtimes.index');
    Route::get('/showtimes/create', Admin\Showtimes\Create::class)->name('showtimes.create');
    Route::get('/showtimes/{showtime}/edit', Admin\Showtimes\Edit::class)->name('showtimes.edit');


    // 🍿 Snacks (Makanan & Minuman)
    Route::get('/snacks', Admin\Snacks\Index::class)->name('snacks.index');
    Route::get('/snacks/create', Admin\Snacks\Create::class)->name('snacks.create');
    Route::get('/snacks/{snack}/edit', Admin\Snacks\Edit::class)->name('snacks.edit');

    // 💳 Transactions
    Route::get('/transactions', Admin\Transactions\Index::class)->name('transactions.index');
    Route::get('/transactions/{transaction}', Admin\Transactions\Detail::class)->name('transactions.detail');

    // 🎟️ Bookings
    Route::get('/bookings', Admin\Bookings\Index::class)->name('bookings.index');
    Route::get('/bookings/create', Admin\Bookings\Index::class)->name('bookings.create');
    Route::get('/bookings/{booking}', Admin\Bookings\Detail::class)->name('bookings.detail');

    // ⭐ Reviews
    Route::get('/reviews', Admin\Reviews\Index::class)->name('reviews.index');
    Route::get('/reviews/{id}', Admin\Reviews\Show::class)->name('reviews.show');

    // 📊 Reports
    Route::get('/reports', Admin\Reports\Index::class)->name('reports.index');

    // 👥 Users
    Route::get('/users', Admin\Users\Index::class)->name('users.index');
    Route::get('/users/{user}', Admin\Users\Detail::class)->name('users.detail');

    // ⚙️ Settings
    Route::get('/settings/site', Admin\Settings\SiteSettings::class)->name('settings.site');
    Route::get('/content/featured', Admin\Content\FeaturedFilms::class)->name('content.featured');
    // 🎟️ Vouchers
    Route::get('/vouchers', Admin\Vouchers\Index::class)->name('vouchers.index');
    Route::get('/vouchers/create', Admin\Vouchers\Upsert::class)->name('vouchers.create');
    Route::get('/vouchers/{id}/edit', Admin\Vouchers\Upsert::class)->name('vouchers.edit');
});
