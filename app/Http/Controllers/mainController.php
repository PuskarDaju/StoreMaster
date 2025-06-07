<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class mainController extends Controller
{
    public function index(){
         return view("welcome");
    }

    public function dashboard(){
        return redirect("/products");
    }
    public function sells(){
        return view('sells.sells');
    }
}
