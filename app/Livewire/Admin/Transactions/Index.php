<?php

namespace App\Livewire\Admin\Transactions;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $transactionType = 'tickets'; // tickets or snacks

    public function render()
    {
        // Map 'cancel' from dropdown to 'cancelled' in database
        $filterStatus = $this->status === 'cancel' ? 'cancelled' : $this->status;

        if ($this->transactionType === 'tickets') {
            $transactions = Transaction::with(['booking.user', 'booking.showtime.film'])
                ->when($this->search, function ($query) {
                    $query->where('id', 'like', '%' . $this->search . '%')
                        ->orWhereHas('booking.user', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('booking.showtime.film', function ($q) {
                            $q->where('title', 'like', '%' . $this->search . '%');
                        });
                })
                ->when($this->status, function ($query) use ($filterStatus) {
                    $query->where('status', $filterStatus);
                })
                ->latest()
                ->paginate(10);

            return view('livewire.admin.transactions.index', [
                'transactions' => $transactions,
                'snackOrders' => collect(),
            ]);
        } else {
            $snackOrders = \App\Models\SnackOrderItem::with(['snackOrder.user', 'snack'])
                ->when($this->search, function ($query) {
                    $query->whereHas('snackOrder.user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('snack', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->status, function ($query) use ($filterStatus) {
                    // Assuming SnackOrder has the status column, or if it's on SnackOrderItem?
                    // Based on previous context, we added status to snack_orders table.
                    // But here we are querying SnackOrderItem. We should filter by the related SnackOrder's status.
                    $query->whereHas('snackOrder', function ($q) use ($filterStatus) {
                        $q->where('status', $filterStatus);
                    });
                })
                ->latest()
                ->paginate(10);

            return view('livewire.admin.transactions.index', [
                'transactions' => collect(),
                'snackOrders' => $snackOrders,
            ]);
        }
    }
}
