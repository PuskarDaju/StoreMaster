<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class SalesPredictionController extends Controller
{
    //
     public function predictNextMonthSales()
    {
//here
    // Get current date
    $now = Carbon::now();

    // Get sales grouped by year and month for last 15 months
    $salesData = DB::table('bills')
        ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_amount) as total_sales')
        ->where('created_at', '>=', $now->copy()->subMonths(15)->startOfMonth())
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    // Prepare x (month index) and y (sales) arrays
    $x = [];
    $y = [];

    $startMonth = $now->copy()->subMonths(14)->startOfMonth(); // 15 months ago

    // Create a map for quick lookup (year-month) => total_sales
    $salesMap = $salesData->mapWithKeys(function ($item) {
        return [sprintf('%04d-%02d', $item->year, $item->month) => $item->total_sales];
    });

    // Fill x and y arrays for continuous 15 months
    for ($i = 0; $i < 15; $i++) {
        $month = $startMonth->copy()->addMonths($i);
        $key = $month->format('Y-m');

        $x[] = $i + 1; // 1-based month index
        $y[] = $salesMap->get($key, 0); // get sales or 0 if none
    }

    // Run the simple linear regression (same as before)
    $n = count($x);
    $meanX = array_sum($x) / $n;
    $meanY = array_sum($y) / $n;

    $numerator = 0;
    $denominator = 0;
    for ($i = 0; $i < $n; $i++) {
        $numerator += ($x[$i] - $meanX) * ($y[$i] - $meanY);
        $denominator += ($x[$i] - $meanX) ** 2;
    }
    $m = $numerator / $denominator;
    $b = $meanY - $m * $meanX;

    // Predict next month (16)
    $nextMonthIndex = 16;
    $predictedSales = $m * $nextMonthIndex + $b;

    return response()->json([
        'months_index' => $x,
        'monthly_sales' => $y,
        'predicted_next_month_sales' => round($predictedSales, 2),
    ]);
}



}


