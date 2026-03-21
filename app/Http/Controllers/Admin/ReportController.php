<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\SnackOrderItem;
use App\Models\Film;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function print(Request $request)
    {
        $startDate = $request->get('startDate', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('endDate', Carbon::now()->endOfMonth()->format('Y-m-d'));
        $reportType = $request->get('reportType', 'tickets');
        $selectedFilm = $request->get('selectedFilm');

        $data = [];

        if ($reportType === 'tickets') {
            $transactions = Transaction::query()
                ->with(['user', 'booking.showtime.film', 'booking.showtime.studio'])
                ->where('status', 'success')
                ->when($startDate, fn($q) => $q->whereDate('created_at', '>=', $startDate))
                ->when($endDate, fn($q) => $q->whereDate('created_at', '<=', $endDate))
                ->when($selectedFilm, fn($q) => $q->whereHas('booking.showtime.film', fn($sq) => $sq->where('id', $selectedFilm)))
                ->latest()
                ->get();

            $totalRevenue = $transactions->sum('amount');
            
            $data = [
                'items' => $transactions,
                'totalRevenue' => $totalRevenue,
                'reportType' => 'Tiket Film',
            ];
        } else {
            $snackOrders = SnackOrderItem::query()
                ->with(['snackOrder.user', 'snack'])
                ->when($startDate, function ($query) use ($startDate) {
                    $query->whereHas('snackOrder', fn($q) => $q->whereDate('created_at', '>=', $startDate));
                })
                ->when($endDate, function ($query) use ($endDate) {
                    $query->whereHas('snackOrder', fn($q) => $q->whereDate('created_at', '<=', $endDate));
                })
                ->latest()
                ->get();

            $totalRevenue = $snackOrders->sum(fn($item) => $item->price * $item->quantity);

            $data = [
                'items' => $snackOrders,
                'totalRevenue' => $totalRevenue,
                'reportType' => 'Makanan & Minuman',
            ];
        }

        $logo = \App\Models\SiteSetting::first()->logo ?? null;

        return view('admin.reports.print', array_merge($data, [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'logo' => $logo,
        ]));
    }
}
