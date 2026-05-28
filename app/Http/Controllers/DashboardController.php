<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $todayTransactions = Transaction::whereDate('created_at', today())->count();
        $todayRevenue = Transaction::whereDate('created_at', today())->sum('total');

        // Data for last 7 days chart
        $labels = [];
        $salesData = [];
        $revenueData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $labels[] = $date->format('d M');
            $salesData[] = Transaction::whereDate('created_at', $date)->count();
            $revenueData[] = Transaction::whereDate('created_at', $date)->sum('total');
        }

        // Recent 5 transactions
        $recentTransactions = Transaction::latest()->take(5)->get();

        return view('dashboard', compact('totalProducts', 'todayTransactions', 'todayRevenue', 'labels', 'salesData', 'revenueData', 'recentTransactions'));
    }
}
