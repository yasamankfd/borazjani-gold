<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLiveOrdersController;
use App\Http\Controllers\AdminManageUsersController;
use App\Http\Controllers\AdminOrdersController;
use App\Http\Controllers\AdminTransactionsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrdersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RefreshData;
use App\Http\Controllers\UserLiveOrdersController;
use App\Http\Controllers\UserSubmitOrder;
use App\Http\Controllers\UserTransactionController;
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
//Route::get("/admin",[AdminController::class,"index"])->name("index");
Route::patch("/admin",[AdminController::class,"update"])->name('admin');
Route::get("/dashboard-admin",[AdminController::class,"index"])->name("dashboard-admin");
Route::get('/market-status/{status}',[AdminController::class,'marketChange']);
Route::get('/product-status/{product}/{status}/{type}',[AdminController::class,'productChange']);
//Route::get('product-single-price/{product_id}/{buy_price}/{sell_price}',[AdminController::class,'singleProductChange']);
Route::get('/find-product/{product_id}',[AdminController::class,'findProduct']);
Route::post('/product-edit',[AdminController::class,'singleProductChange'])->name("product-edit");
Route::get('/admin-liveorders',[AdminLiveOrdersController::class,'index'])->name("admin-liveorders");
Route::post('/admin-save-order',[AdminLiveOrdersController::class,'orderSave'])->name("admin-save-order");
Route::get('/admin-transactions',[AdminTransactionsController::class,'index'])->name("admin-transactions");
Route::get('/admin-manage-users',[AdminManageUsersController::class,'index'])->name("admin-manage-users");
Route::get("/market-change",[AdminController::class,"showMarketChange"])->name("market-change");
Route::get("/list-products" ,[AdminLiveOrdersController::class,"list_products"]);

Route::post('/product-create',[AdminController::class,'create'])->name("product-create");
Route::get("base_information_admin" , [AdminController::class,"baseInformation"])->name("base-information");

Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");
Route::get("/user-order/{product}/{type}",[UserSubmitOrder::class,"index"]);
Route::get('/user-liveorders/{user_id}', [UserLiveOrdersController::class , 'index'])->name('user-liveorders');
Route::get('/user-profile/{user_id}', [\App\Http\Controllers\UserProfileController::class , 'index'])->name('user-profile');

//refresh data after
Route::get('/update', [RefreshData::class,'getUpdatedData']);
Route::get('/user-transactions/{user_id}', [UserTransactionController::class,'index'])->name("user-transactions");



Route::get('/order/{product}/{type}',[OrderController::class,'index']);
Route::post('/order',[UserSubmitOrder::class,'store'])->name('save-temp-order');
Route::get('/admin-orders', [AdminOrdersController::class,'index'])->name('admin-orders');


Route::get("/customer", [CustomerController::class,"index"])->name('customer');
Route::get('/customer-orders/{user_id}', [CustomerOrdersController::class,'index'])->name('customer-orders');
Route::post('/order',[OrderController::class,'store'])->name('save-temp-order');

//Route::get('/listen', function () {
//    return view('listen');
//});
//Route::get('/event', function () {
////    event(new \App\Events\MessageNotification("this is my message to u"));
//});
