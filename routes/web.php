<?php

use App\Http\Middleware\RoleMiddleware;
use App\Livewire\User;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\TermsAndConditions;
use App\Livewire\Home;
use App\Http\Controllers\MidtransController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Film;
use App\Models\Genre;

//
// ─── PUBLIC ROUTES ──────────────────────────────────────────────────────────
//
Route::get('/', function () {
    $search = request('search');
    $genreId = request('genre');

    // Get featured film IDs
    $nowShowingIds = \App\Models\FeaturedFilm::nowShowing()->pluck('film_id');
    $comingSoonIds = \App\Models\FeaturedFilm::comingSoon()->pluck('film_id');

    // Now Showing Films with search and filter
    $nowShowingFilms = Film::whereIn('id', $nowShowingIds)
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
        ->when($genreId, function ($query, $genreId) {
            $query->whereHas('genres', function ($q) use ($genreId) {
                $q->where('genres.id', $genreId);
            });
        })
        ->get();

    // Coming Soon Films with search and filter
    $comingSoonFilms = Film::whereIn('id', $comingSoonIds)
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
        ->when($genreId, function ($query, $genreId) {
            $query->whereHas('genres', function ($q) use ($genreId) {
                $q->where('genres.id', $genreId);
            });
        })
        ->get();

    $genres = Genre::all();
    return view('welcome', compact('nowShowingFilms', 'comingSoonFilms', 'genres', 'search', 'genreId'));
})->name('home');
Route::get('/films', User\Showtimes\Index::class)->name('films.index');
Route::get('/films/{film}', User\Showtimes\Show::class)->name('films.show');
Route::get('/snacks', User\Snacks\Index::class)->name('snacks.index');
Route::get('/terms', TermsAndConditions::class)->name('terms');

//
// ─── AUTH ROUTES ────────────────────────────────────────────────────────────
//
Route::get('login', Login::class)->name('login');
Route::get('register', Register::class)->name('register');
Route::get('forgot-password', ForgotPassword::class)->name('password.request');
Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');

Route::post('logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    session()->flash('success', 'Anda telah berhasil logout.');

    return redirect('/');
})->name('logout');

//
// ─── PROTECTED ROUTES (AUTH REQUIRED) ───────────────────────────────────────
//
    Route::post('/midtrans/notification', [MidtransController::class, 'notificationHandler']);
//
// ─── ADMIN ROUTES ───────────────────────────────────────────────────────
//

require __DIR__ . "/admin.php";

//
// ─── USER ROUTES ────────────────────────────────────────────────────────
//

require __DIR__ . "/user.php";


//
// ─── LOGOUT ROUTE ───────────────────────────────────────────────────────────
//
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
