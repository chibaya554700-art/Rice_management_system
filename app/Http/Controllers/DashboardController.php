<?php

namespace App\Http\Controllers;

use App\Models\RiceItem;
use App\Models\Order;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalRiceItems' => RiceItem::count(),
            'totalOrders'    => Order::count(),
            'totalPayments'  => Payment::count(),
            'totalRevenue'   => Payment::sum('amount'),
            'recentOrders'   => Order::with('riceItem')
                            ->latest()
                            ->take(5)
                            ->get(),
        ]);
    }
}