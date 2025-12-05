<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
        <h1 class="text-3xl font-bold text-amber-500 mb-4 sm:mb-0 drop-shadow-md">
            Daftar Transaksi
        </h1>
    </div>

    {{-- Tabs --}}
    <div class="mb-6 flex gap-2">
        <button wire:click="$set('transactionType', 'tickets')"
                class="px-6 py-2.5 rounded-lg font-bold transition-all {{ $transactionType === 'tickets' ? 'bg-amber-500 text-slate-900' : 'bg-slate-800 text-gray-400 hover:text-white' }}">
            Transaksi Tiket
        </button>
        <button wire:click="$set('transactionType', 'snacks')"
                class="px-6 py-2.5 rounded-lg font-bold transition-all {{ $transactionType === 'snacks' ? 'bg-amber-500 text-slate-900' : 'bg-slate-800 text-gray-400 hover:text-white' }}">
            Transaksi Makanan
        </button>
    </div>

    <div class="mb-4 flex flex-col sm:flex-row justify-between gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" 
               placeholder="{{ $transactionType === 'tickets' ? 'Cari Order ID, User, atau Film...' : 'Cari User atau Makanan...' }}" 
               class="w-full sm:w-1/3 bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 placeholder-gray-400 focus:outline-none focus:border-amber-500/50">
        
        <div x-data="{ open: false, selected: @entangle('status') }" class="relative w-full sm:w-48">
            <button @click="open = !open" 
                    @click.away="open = false"
                    type="button"
                    class="w-full bg-slate-800/50 border border-slate-700 rounded-lg px-4 py-2 text-gray-100 focus:outline-none focus:border-amber-500/50 flex justify-between items-center">
                <span x-text="selected ? selected.charAt(0).toUpperCase() + selected.slice(1) : 'Semua Status'"></span>
                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200 origin-top"
                 x-transition:enter-start="opacity-0 scale-y-0"
                 x-transition:enter-end="opacity-100 scale-y-100"
                 x-transition:leave="transition ease-in duration-150 origin-top"
                 x-transition:leave-start="opacity-100 scale-y-100"
                 x-transition:leave-end="opacity-0 scale-y-0"
                 class="absolute z-50 mt-2 w-full bg-slate-800 border border-slate-700 rounded-lg shadow-xl max-h-60 overflow-y-auto scroll-smooth custom-scrollbar"
                 style="display: none;">
                
                <div class="py-1">
                    <div @click="selected = ''; open = false"
                         class="px-4 py-2 text-sm text-gray-300 hover:bg-slate-700 cursor-pointer transition-colors"
                         :class="selected === '' ? 'text-amber-500 font-bold bg-slate-700/50' : ''">
                        Semua Status
                    </div>
                    @foreach(['pending', 'settlement', 'capture', 'failure', 'expire', 'cancel'] as $statusOption)
                        <div @click="selected = '{{ $statusOption }}'; open = false"
                             class="px-4 py-2 text-sm text-gray-300 hover:bg-slate-700 cursor-pointer transition-colors capitalize"
                             :class="selected === '{{ $statusOption }}' ? 'text-amber-500 font-bold bg-slate-700/50' : ''">
                            {{ $statusOption }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @if($transactionType === 'tickets')
        {{-- Tickets Table --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-700">
                    <thead class="bg-slate-900">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                ID
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                User
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                Film
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                Total
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-center text-gray-400 uppercase">
                                Status
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                Tanggal
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-center text-gray-400 uppercase">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($transactions as $transaction)
                            <tr class="hover:bg-slate-700/30 transition-colors duration-200">
                                <td class="px-3 py-3">
                                    <span class="font-mono text-xs text-gray-300 bg-slate-700 px-1.5 py-0.5 rounded">
                                        #{{ substr($transaction->id, 0, 6) }}
                                    </span>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-sm font-medium text-white max-w-[120px] truncate">
                                        {{ $transaction->booking->user->name }}
                                    </div>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-sm text-gray-300 max-w-[150px] truncate" title="{{ $transaction->booking->showtime->film->title }}">
                                        {{ $transaction->booking->showtime->film->title }}
                                    </div>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-sm font-bold text-amber-500 whitespace-nowrap">
                                        Rp {{ number_format($transaction->amount / 1000, 0) }}k
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <span @class([
                                        'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium',
                                        'bg-green-500/10 text-green-400' => $transaction->status == 'settlement' || $transaction->status == 'capture',
                                        'bg-yellow-500/10 text-yellow-400' => $transaction->status == 'pending',
                                        'bg-red-500/10 text-red-400' => $transaction->status == 'failure' || $transaction->status == 'expire' || $transaction->status == 'cancel',
                                    ])>
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-xs text-gray-400 whitespace-nowrap">
                                        {{ $transaction->created_at->format('d/m/y H:i') }}
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <a href="{{ route('admin.transactions.detail', $transaction->id) }}" 
                                       class="text-amber-500 hover:text-amber-400 text-sm font-medium">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-16">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                        </svg>
                                        <p class="text-gray-400 text-lg font-medium">Belum ada transaksi tiket.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-700 bg-slate-800">
                {{ $transactions->links() }}
            </div>
        </div>
    @else
        {{-- Snacks Table --}}
        <div class="bg-slate-800 rounded-xl shadow-2xl shadow-black/50 border border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-700">
                    <thead class="bg-slate-900">
                        <tr>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                ID
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                User
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                Makanan
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-center text-gray-400 uppercase">
                                Qty
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-center text-gray-400 uppercase">
                                Status
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                Total
                            </th>
                            <th scope="col" class="px-3 py-3 text-xs font-bold tracking-wider text-left text-gray-400 uppercase">
                                Tanggal
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($snackOrders as $item)
                            <tr class="hover:bg-slate-700/30 transition-colors duration-200">
                                <td class="px-3 py-3">
                                    <span class="font-mono text-xs text-gray-300 bg-slate-700 px-1.5 py-0.5 rounded">
                                        #{{ substr($item->snackOrder->id, 0, 6) }}
                                    </span>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-sm font-medium text-white max-w-[120px] truncate">
                                        {{ $item->snackOrder->user->name }}
                                    </div>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-sm font-medium text-white max-w-[150px] truncate" title="{{ $item->snack->name }}">
                                        {{ $item->snack->name }}
                                    </div>
                                    <div class="text-xs text-gray-400">{{ $item->snack->type }}</div>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <div class="text-sm text-gray-300">{{ $item->quantity }}</div>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <span @class([
                                        'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium',
                                        'bg-green-500/10 text-green-400' => $item->snackOrder->status == 'settlement' || $item->snackOrder->status == 'capture',
                                        'bg-yellow-500/10 text-yellow-400' => $item->snackOrder->status == 'pending',
                                        'bg-red-500/10 text-red-400' => $item->snackOrder->status == 'failure' || $item->snackOrder->status == 'expire' || $item->snackOrder->status == 'cancelled',
                                    ])>
                                        {{ ucfirst($item->snackOrder->status ?? 'Unknown') }}
                                    </span>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-sm font-bold text-amber-500 whitespace-nowrap">
                                        Rp {{ number_format(($item->price * $item->quantity) / 1000, 0) }}k
                                    </div>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="text-xs text-gray-400 whitespace-nowrap">
                                        {{ $item->snackOrder->created_at->format('d/m/y H:i') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-16">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                        <p class="text-gray-400 text-lg font-medium">Belum ada transaksi makanan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-700 bg-slate-800">
                {{ $snackOrders->links() }}
            </div>
        </div>
    @endif
</div>
