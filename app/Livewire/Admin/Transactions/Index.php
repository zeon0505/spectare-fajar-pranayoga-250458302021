<?php

namespace App\Livewire\Admin\Transactions;

use Livewire\Component;
use App\Models\Transaction;

class Index extends Component
{
    public $transactions;

    public function mount()
    {
        $this->transactions = Transaction::with('user')->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.transactions.index');
    }
}
