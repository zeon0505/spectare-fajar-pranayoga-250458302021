<?php

namespace App\Livewire\Admin\Transactions;

use Livewire\Component;
use App\Models\Transaction;

class Detail extends Component
{
    public $transaction;

    public function mount($id)
    {
        $this->transaction = Transaction::with(['user', 'bookingSeats.showtime.film'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.transactions.detail');
    }
}
