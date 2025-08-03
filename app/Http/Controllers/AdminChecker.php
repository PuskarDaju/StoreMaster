<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminChecker{
    public function checkAdmin(){
         if(Auth::user()->role=="admin"){
            return true;
         }
         return false;         
    }
}
?>