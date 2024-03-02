<?php
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLiveOrdersController;
use App\Http\Controllers\Admin\AdminManageCustomersController;
use App\Http\Controllers\Admin\AdminManageUsersController;
use App\Http\Controllers\Admin\AdminProducts;
use App\Http\Controllers\Admin\AdminTransactionsController;
//use App\Http\Controllers\AdminOrdersController;
//use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerDashboardController;
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
//Route::resource('/dashboard',AdminDashboardController::class);
//Route::get("/admin",[AdminDashboardController::class,"index"])->name("index");


Route::patch("/admin",[AdminDashboardController::class,"update"])->name('admin');
Route::get("/dashboard-admin",[AdminDashboardController::class,"index"])->name("dashboard-admin");
Route::get('/market-status/{status}',[AdminDashboardController::class,'marketChange']);
Route::get('/product-status/{product}/{status}/{type}',[AdminDashboardController::class,'productChange']);
//Route::get('product-single-price/{product_id}/{buy_price}/{sell_price}',[AdminDashboardController::class,'singleProductChange']);
Route::get('/find-product/{product_id}',[AdminDashboardController::class,'findProduct']);
Route::post('/product-edit',[AdminDashboardController::class,'singleProductChange'])->name("product-edit");
Route::get('/admin-liveorders',[AdminLiveOrdersController::class,'index'])->name("admin-liveorders");
Route::post('/admin-save-order',[AdminLiveOrdersController::class,'orderSave'])->name("admin-save-order");
Route::get('/admin-transactions',[AdminTransactionsController::class,'index'])->name("admin-transactions");
Route::get('/admin-manage-customers',[AdminManageCustomersController::class,'index'])->name("admin-manage-customers");
Route::get("/market-change",[AdminDashboardController::class,"showMarketChange"])->name("market-change");
Route::get("/customer-list-products" ,[CustomerDashboardController::class,"list_products"]);


Route::get('/find-customer/{customer_id}',[AdminManageCustomersController::class,'findCustomer']);
Route::get("/admin-list-orders" ,[AdminLiveOrdersController::class,"list_orders"]);
Route::get("/admin-dashboard-list-products" ,[AdminDashboardController::class,"list_dashboard_products"]);
Route::get("/admin-list-products" ,[AdminProducts::class,"list_admin_products"]);

Route::get("/admin-list-transactions-buy" ,[AdminTransactionsController::class,"list_transactions_buy"]);
Route::get("/admin-list-transactions-sell" ,[AdminTransactionsController::class,"list_transactions_sell"]);
Route::get("/admin-list-customers" ,[AdminManageCustomersController::class,"list_customers"]);
Route::post('/customer-create',[AdminManageCustomersController::class,'create'])->name("customer-create");
Route::get('/find-user/{user_id}',[AdminManageUsersController::class,'findUser']);


Route::post('/product-create',[AdminProducts::class,'create_product'])->name("product-create");
Route::get('/admin-products' , [AdminProducts::class,"index"])->name("admin-products");

Route::get("/admin-list-users" ,[AdminManageUsersController::class,"list_users"]);
Route::post('/user-create',[AdminManageUsersController::class,'create'])->name("user-create");
Route::get('/admin-manage-users',[AdminManageUsersController::class,'index'])->name("admin-manage-users");


Route::get("/user-list-transactions-buy/{user_id}" ,[UserTransactionController::class,"list_transactions_buy"]);
Route::get("/user-list-transactions-sell/{user_id}" ,[UserTransactionController::class,"list_transactions_sell"]);
Route::get("/user-list-orders" ,[UserLiveOrdersController::class,"list_orders"]);
Route::get("/dashboard",[CustomerDashboardController::class,"index"])->name("dashboard");
Route::get("/user-order/{product}/{type}",[UserSubmitOrder::class,"index"]);
Route::get('/user-liveorders', [UserLiveOrdersController::class , 'index'])->name('user-liveorders');
Route::get('/user-profile/{user_id}', [\App\Http\Controllers\UserProfileController::class , 'index'])->name('user-profile');

//refresh data after
Route::get('/update', [RefreshData::class,'getUpdatedData']);
Route::get('/user-transactions/{user_id}', [UserTransactionController::class,'index'])->name("user-transactions");



Route::get('/order/{product}/{type}',[OrderController::class,'index']);
Route::post('/order',[UserSubmitOrder::class,'store'])->name('save-temp-order');

