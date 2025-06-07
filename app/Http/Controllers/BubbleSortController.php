<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class BubbleSortController extends Controller
{
public static function getSorted(array $products, string $order = 'asc'){

        $n = count($products);

    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            $name1 = strtolower($products[$j]['name']);
            $name2 = strtolower($products[$j + 1]['name']);

            $shouldSwap = $order === 'asc' 
                ? $name1 > $name2 
                : $name1 < $name2;

            if ($shouldSwap) {
                $temp = $products[$j];
                $products[$j] = $products[$j + 1];
                $products[$j + 1] = $temp;
            }
        }
    }

    return $products;
}
}

