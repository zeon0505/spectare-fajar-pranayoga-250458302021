<?php

namespace App\Livewire\Features;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Film;
use App\Models\Studio;
use App\Models\Showtime;
use App\Models\Booking;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    #[Layout('layouts.app')]
    public $title = 'Dashboard';

    // Summary data
    public $totalFilms;
    public $totalStudios;
    public $totalShowtimes;
    public $totalBookings;
    public $totalTransactions;
    public $totalUsers;

    // Chart data: transaksi per bulan
    public $transactionsPerMonth = [];

    public function mount()
    {
        // === SUMMARY ===
        $this->totalFilms        = Film::count();
        $this->totalStudios      = Studio::count();
        $this->totalShowtimes    = Showtime::count();
        $this->totalBookings     = Booking::count();
        $this->totalTransactions = Transaction::count();
        $this->totalUsers        = User::count();

        // === TRANSAKSI PER BULAN ===
        $transactions = Transaction::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->get();

        // Siapkan array 12 bulan
        $perMonth = array_fill(1, 12, 0);
        foreach ($transactions as $trx) {
            $perMonth[$trx->bulan] = $trx->total;
        }

        $this->transactionsPerMonth = array_values($perMonth);
    }

    public function render()
    {
        return view('livewire.features.dashboard');
    }
}
