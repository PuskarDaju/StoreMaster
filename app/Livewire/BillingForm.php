<?php

namespace App\Livewire;
use App\Models\Product;

use Livewire\Component;

class BillingForm extends Component
{
    public $products;
    public $selectedProducts = [];
    public $quantities = [];
    public $totalAmount = 0;
    public $paidAmount = 0;
    public $changeAmount = 0;

    public function mount()
    {
        $this->products = Product::all();
    }

    public function updated($field)
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->totalAmount = 0;
        foreach ($this->selectedProducts as $key => $productId) {
            $product = Product::find($productId);
            $quantity = $this->quantities[$key];
            $this->totalAmount += $product->price * $quantity;
        }

        $this->calculateChange();
    }

    public function calculateChange()
    {
        $this->changeAmount = $this->paidAmount - $this->totalAmount;
    }

    public function render()
    {
        return view('livewire.billing-form');
    }
}
