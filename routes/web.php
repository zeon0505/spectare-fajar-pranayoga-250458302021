<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// AUTH
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

// ADMIN
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Films\Index as AdminFilms;
use App\Livewire\Admin\Films\Create as AdminFilmCreate;
use App\Livewire\Admin\Films\Edit as AdminFilmEdit;
use App\Livewire\Admin\Studios\Index as StudiosIndex;
use App\Livewire\Admin\Studios\Create as StudiosCreate;
use App\Livewire\Admin\Studios\Edit as StudiosEdit;
use App\Livewire\Admin\Showtimes\Index as ShowtimesIndex;
use App\Livewire\Admin\Showtimes\Create as ShowtimesCreate;
use App\Livewire\Admin\Showtimes\Edit as ShowtimesEdit;
use App\Livewire\Admin\Transactions\Index as TransactionsIndex;
use App\Livewire\Admin\Transactions\Detail as TransactionsDetail;

// USER
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\Films\Index as UserFilms;
use App\Livewire\User\Films\Show as UserFilmShow;

Route::get('/', function () {
    return view('welcome');
});

// === AUTH ===
Route::prefix('auth')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// === PROTECTED ===
Route::middleware(['auth'])->group(function () {

    // ADMIN
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/films', AdminFilms::class)->name('films.index');
        Route::get('/films/create', AdminFilmCreate::class)->name('films.create');
        Route::get('/films/{id}/edit', AdminFilmEdit::class)->name('films.edit');

        Route::get('/studios', StudiosIndex::class)->name('studios.index');
        Route::get('/studios/create', StudiosCreate::class)->name('studios.create');
        Route::get('/studios/{id}/edit', StudiosEdit::class)->name('studios.edit');

        Route::get('/showtimes', ShowtimesIndex::class)->name('showtimes.index');
        Route::get('/showtimes/create', ShowtimesCreate::class)->name('showtimes.create');
        Route::get('/showtimes/{id}/edit', ShowtimesEdit::class)->name('showtimes.edit');

        Route::get('/transactions', TransactionsIndex::class)->name('transactions.index');
        Route::get('/transactions/{id}', TransactionsDetail::class)->name('transactions.detail');
    });

    // USER
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', UserDashboard::class)->name('dashboard');
        Route::get('/films', UserFilms::class)->name('films.index');
          Route::get('/films/{id}', UserFilmShow::class)->name('user.films.show');

    });

    // LOGOUT
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});
