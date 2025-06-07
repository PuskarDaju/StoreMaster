<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;
use App\Models\BillItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    //
    public function store(Request $request)
{

    
  

    try {
        $bill = Bill::create([
            'bill_number' => 'BIL-' . strtoupper(uniqid()),
            'cashier_id' => Auth::user()->id,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'change_amount' => $request->paid_amount - $request->total_amount,
        ]);

        dd($request);

        // foreach ($request->items as $item) {
        //     BillItem::create([
        //         'bill_id' => $bill->id,
        //         'product_id' => $item['product_id'],
        //         'quantity' => $item['quantity'],
        //         'price' => $item['price'],
        //         'subtotal' => $item['price'] * $item['quantity'],
        //     ]);

        //     // Optional: Decrease stock
        //     // Product::where('id', $item['product_id'])->decrement('stock', $item['quantity']);
        // }

      
       return redirect('/products');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => $e->getMessage()]);
    }

}
// public function index()
// {
//     // Show a list of bills
//     $bills = Bill::all();
//     return view('billing.create', compact('bills'));
// }

public function create()
{
    // Fetch all products for the billing form
    $products = Product::all();
    return view('billing.create', compact('products'));
}
public function downloadPDF($id)
{
    // Generate the PDF using DOMPDF
    $bill = Bill::with('items.product')->findOrFail($id);
    $pdf = Pdf::loadView('bills.invoice_pdf', compact('bill'));
    return $pdf->download('Bill-' . $bill->bill_number . '.pdf');
}
}
