<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrdersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RefreshData;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::resource('/dashboard',AdminController::class);
Route::get("/admin",[AdminController::class,"index"])->name("index");
Route::get("/customer", [CustomerController::class,"index"])->name('customer');
Route::patch("/admin",[AdminController::class,"update"])->name('admin');
Route::get('/market-status/{status}',[AdminController::class,'marketChange']);
Route::get('/product-status/{product}/{status}',[AdminController::class,'productChange']);

Route::get('/update', [RefreshData::class,'getUpdatedData']);
Route::get('/customer-orders/{user_id}', [CustomerOrdersController::class,'index'])->name('customer-orders');


Route::get('/order/{product}/{type}',[OrderController::class,'index']);
Route::post('/order',[OrderController::class,'store'])->name('save-temp-order');

//Route::get('/listen', function () {
//    return view('listen');
//});
//Route::get('/event', function () {
////    event(new \App\Events\MessageNotification("this is my message to u"));
//});
