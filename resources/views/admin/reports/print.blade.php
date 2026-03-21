<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan - Spectare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: white; color: #0f172a; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
        @media print {
            .no-print { display: none; }
            body { background: white; padding: 0; margin: 0; }
            .print-padding { padding: 20px; }
            @page { size: A4; margin: 1cm; }
        }
        .accent-border { border-left: 4px solid #f59e0b; }
        .bg-spectare-light { background-color: #fef3c7; }
        .text-spectare { color: #d97706; }
    </style>
</head>
<body class="print-padding">
    <div class="max-w-4xl mx-auto p-8">
        {{-- Header --}}
        <div class="flex justify-between items-center border-b-4 border-amber-500 pb-6 mb-8">
            <div class="flex items-center gap-4">
                @if($logo)
                    <img src="{{ Storage::url($logo) }}" alt="Logo" class="h-16 w-16 object-contain">
                @else
                    <div class="h-16 w-16 bg-amber-500 rounded-xl flex items-center justify-center text-white font-black text-2xl">S</div>
                @endif
                <div>
                    <h1 class="text-3xl font-black text-slate-900 uppercase tracking-tighter">SPECTARE CINEMA</h1>
                    <p class="text-sm text-gray-500 font-bold uppercase tracking-widest">Premium Movie Experience</p>
                </div>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-bold text-amber-600 uppercase">LAPORAN PENJUALAN</h2>
                <p class="text-sm font-medium text-gray-400">{{ $reportType }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
            </div>
        </div>

        {{-- I. Ringkasan Laporan --}}
        <div class="mb-10">
            <div class="flex items-center gap-2 mb-4">
                <div class="h-8 w-1 bg-amber-500"></div>
                <h3 class="text-lg font-black uppercase tracking-wider text-slate-800">I. RINGKASAN PENDAPATAN</h3>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <p class="text-xs font-bold text-slate-400 uppercase mb-1">Total Pendapatan</p>
                    <h4 class="text-3xl font-black text-amber-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h4>
                </div>
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 shadow-sm">
                    <p class="text-xs font-bold text-slate-400 uppercase mb-1">Total Transaksi</p>
                    <h4 class="text-3xl font-black text-indigo-600">{{ $items->count() }}</h4>
                </div>
            </div>
        </div>

        {{-- II. Grafik Visualisasi --}}
        <div class="mb-10 page-break-inside-avoid">
            <div class="flex items-center gap-2 mb-4">
                <div class="h-8 w-1 bg-indigo-500"></div>
                <h3 class="text-lg font-black uppercase tracking-wider text-slate-800">II. GRAFIK ANALISIS</h3>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>

        {{-- III. Rincian Transaksi --}}
        <div class="mb-10">
            <div class="flex items-center gap-2 mb-4">
                <div class="h-8 w-1 bg-slate-800"></div>
                <h3 class="text-lg font-black uppercase tracking-wider text-slate-800">III. RINCIAN TRANSAKSI</h3>
            </div>
            <table class="w-full text-left border-collapse border border-slate-200 rounded-xl overflow-hidden">
                <thead>
                    <tr class="bg-slate-100 text-slate-600 text-xs font-bold uppercase">
                        <th class="p-4 border border-slate-200">No</th>
                        <th class="p-4 border border-slate-200">Tanggal</th>
                        @if($reportType === 'Tiket Film')
                            <th class="p-4 border border-slate-200">Film</th>
                            <th class="p-4 border border-slate-200">Studio / Kursi</th>
                        @else
                            <th class="p-4 border border-slate-200">Item</th>
                            <th class="p-4 border border-slate-200">Qty</th>
                        @endif
                        <th class="p-4 border border-slate-200 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($items as $index => $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-4 border border-slate-200 text-center">{{ $index + 1 }}</td>
                            <td class="p-4 border border-slate-200">
                                <div class="font-bold">{{ $item->created_at->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-400">{{ $item->created_at->format('H:i') }}</div>
                            </td>
                            @if($reportType === 'Tiket Film')
                                <td class="p-4 border border-slate-200">
                                    <div class="font-bold text-slate-800">{{ $item->booking->showtime->film->title ?? '-' }}</div>
                                    <div class="text-xs text-indigo-500 font-bold italic">{{ $item->user->name ?? 'Guest' }}</div>
                                </td>
                                <td class="p-4 border border-slate-200">
                                    <div class="text-xs font-bold">{{ $item->booking->showtime->studio->name ?? '-' }}</div>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @foreach(json_decode($item->seats ?? '[]') as $seat)
                                            <span class="px-1.5 py-0.5 bg-slate-100 text-[10px] font-bold border border-slate-200 rounded">{{ $seat }}</span>
                                        @endforeach
                                    </div>
                                </td>
                            @else
                                <td class="p-4 border border-slate-200">
                                    <div class="font-bold text-slate-800">{{ $item->snack->name ?? '-' }}</div>
                                    <div class="text-xs text-indigo-500 font-bold italic">{{ $item->snackOrder->user->name ?? 'Guest' }}</div>
                                </td>
                                <td class="p-4 border border-slate-200 text-center font-bold">{{ $item->quantity }}</td>
                            @endif
                            <td class="p-4 border border-slate-200 text-right font-black text-amber-600">
                                @if($reportType === 'Tiket Film')
                                    Rp {{ number_format($item->amount, 0, ',', '.') }}
                                @else
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-gray-400 italic">Tidak ada data transaksi ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-slate-900 text-white font-black">
                        <td colspan="{{ $reportType === 'Tiket Film' ? '4' : '4' }}" class="p-4 text-right uppercase tracking-widest">TOTAL KESELURUHAN</td>
                        <td class="p-4 text-right text-amber-400">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Footer & Tanda Tangan --}}
        <div class="mt-20 flex justify-end page-break-inside-avoid">
            <div class="text-center w-64">
                <p class="text-sm font-medium mb-1">Jakarta, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="text-sm font-bold uppercase tracking-wider mb-20 text-slate-800">Manager Operasional</p>
                
                <div class="border-b-2 border-slate-800 mx-auto w-48 mb-2"></div>
                <p class="text-sm font-black uppercase text-slate-900">Spectare Admin Team</p>
                <p class="text-xs text-gray-400 font-bold italic">Generated by Spectare System</p>
            </div>
        </div>

        {{-- Print Buttons --}}
        <div class="mt-8 flex justify-center gap-4 no-print">
            <button onclick="window.print()" class="px-8 py-3 bg-amber-500 hover:bg-amber-600 text-white font-black rounded-xl transition-all shadow-lg shadow-amber-500/30 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                CETAK LAPORAN (PDF)
            </button>
            <button onclick="window.close()" class="px-8 py-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-black rounded-xl transition-all">
                TUTUP
            </button>
        </div>
    </div>

    {{-- Chart JS Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            
            @php
                $chartData = $items->groupBy(fn($item) => $item->created_at->format('d/m'))->map(fn($group) => $reportType === 'Tiket Film' ? $group->sum('amount') : $group->sum(fn($i) => $i->price * $i->quantity));
            @endphp

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartData->keys()) !!},
                    datasets: [{
                        label: 'Penjualan (Rp)',
                        data: {!! json_encode($chartData->values()) !!},
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#f59e0b',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString();
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
