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
    //use App\Models\Bill;


public function store(Request $request)
{
    $productIds = $request->input('product_id');
    for($i=0;$i<count($productIds);$i++){
        $productId=$productIds[$i];
         $product = Product::find($productId);
         $quantities=$request->input('quantity');
         $requestedQuantity=$quantities[$i];
         
         if (!$product || $product->stock_quantity< $requestedQuantity) {
        return redirect()->back()->withInput()->withErrors(['message' => 'Insufficient stock or product not found.']);
    
    }
}
    DB::beginTransaction();

    try {
        // Step 1: Create Bill
        $bill = Bill::create([
            'bill_number' => 'BIL-' . strtoupper(uniqid()),
            'cashier_id' => Auth::id(),
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'change_amount' => $request->paid_amount - $request->total_amount,
        ]);

        // Step 2: Handle items (based on indexed arrays)
        
        
        $rates      = $request->input('rate');

        for ($i = 0; $i < count($productIds); $i++) {
            $productId = $productIds[$i];
            $quantity  = $quantities[$i];
            $rate      = $rates[$i];
            $subtotal  = $quantity * $rate;

            BillItem::create([
                'bill_id'    => $bill->id,
                'product_id' => $productId,
                'quantity'   => $quantity,
                'price'      => $rate,
                'subtotal'   => $subtotal,
            ]);

            // Optional: Reduce stock
            Product::where('id', $productId)->decrement('stock_quantity', $quantity);
        }

        DB::commit();

        // Step 3: Redirect to the print page
        return redirect()->route('bills.print', $bill->id);

    } catch (\Exception $e) {
        DB::rollBack();
        // return back()->with('error', 'Bill creation failed: ' . $e->getMessage());
        dd($e->getMessage());
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
public function print($id) {
      $bill = Bill::with('items.product')->findOrFail($id);
    return view('billing.print', compact('bill'));
    
}
}
