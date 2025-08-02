<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
   public function totalBills(){
    return response()->json([
        "bills"=>Bill::count(),
    ]);
   }
  
    public function revenueByCategory()
    {
        $revenue = BillItem::with('product.category')
            ->get()
            ->groupBy(function ($item) {
                return $item->product->category->name ?? 'Uncategorized';
            })
            ->map(function ($group) {
                return $group->sum('subtotal');
            });

        return response()->json($revenue);
    }

    public function topSoldItemsByUnit(){
        $topItems = BillItem::select('product_id', DB::raw('SUM(quantity) as total_units'))
            ->with('product') // eager load product details
            ->groupBy('product_id')
            ->orderByDesc('total_units')
            ->take(3)
            ->get()
            ->map(function($item) {
                return [
                    'product_name' => $item->product->name ?? 'Unknown',
                    'units_sold' => $item->total_units
                ];
            });

        return response()->json($topItems);
    }

    
    public function topSoldItemsByRevenue(){
         $topItems = DB::table('bill_items')
        ->join('bills', 'bill_items.bill_id', '=', 'bills.id')
        ->join('products', 'bill_items.product_id', '=', 'products.id')
        ->whereYear('bills.created_at', now()->year)
        ->select(
            'products.name as product_name',
            DB::raw('SUM(bill_items.price * bill_items.quantity) as total_revenue')
        )
        ->groupBy('bill_items.product_id', 'products.name')
        ->orderByDesc('total_revenue')
        ->take(3)
        ->get();

    if ($topItems->isEmpty()) {
        return response()->json(['message' => 'No sales data found'], 404);
    }

    return response()->json($topItems);
    }
    
public function totalSalesPerMonth()
{  $currentYear = now()->year;

    $salesPerMonth = Bill::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_sales')
        ->whereYear('created_at', $currentYear) // filter by current year
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    return response()->json($salesPerMonth);
}


public function getMonthlySalesData()
{
    $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
    $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

    $salesData = DB::table('bills')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_sales'))
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get();

    return response()->json($salesData);
}
public function getWeeklySalesData()
{
    // Don't use toDateString(); keep full datetime
    $startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY);
    $endOfWeek = Carbon::now()->endOfWeek(Carbon::SATURDAY)->endOfDay();

    $salesData = DB::table('bills')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_sales'))
        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get();

    return response()->json($salesData);
}


public function getTodaySalesData()
{
    $today = Carbon::today()->toDateString();

    $salesData = DB::table('bills')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_amount) as total_sales'))
        ->whereDate('created_at', $today)
        ->groupBy(DB::raw('DATE(created_at)'))
        ->get();

    return response()->json($salesData);
}



}
