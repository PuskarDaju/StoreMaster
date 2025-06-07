<?php


use App\Http\Controllers\BillController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\mainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesPredictionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserIsLoggedIn;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;



Route::get('/', [mainController::class, 'index'])->name('MyHome');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(EnsureUserIsLoggedIn::class)->group(function(){

    Route::resource("products",ProductController::class);

Route::resource("category",CategoryController::class);

Route::controller(BillController::class)->group(function(){
    Route::get('/bills','create')->name('bills.create');
    Route::post('/store','store')->name('bills.store');
    // Route::get('/bills/index','index')->name('bills.index');
});
Route::controller(mainController::class)->group(function(){
 
  Route::get("dashboard","dashboard");
  Route::get("sell","sells")->name('sell');

});
Route::get('/search',[ProductController::class, 'search'])->name("products.search");

Route::controller(SalesController::class)->group(function(){
    Route::get("/revenueByCategory",'revenueByCategory');
    Route::get("/topSoldItemsByUnit",'topSoldItemsByUnit');
    Route::get("/topSoldItemsByRevenue",'topSoldItemsByRevenue');
    Route::get("/total-sales-per-month",'totalSalesPerMonth');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/predict-sales', [SalesPredictionController::class, 'predictNextMonthSales']);


});