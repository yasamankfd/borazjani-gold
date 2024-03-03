<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLiveOrdersController;
use App\Http\Controllers\Admin\AdminManageCustomersController;
use App\Http\Controllers\Admin\AdminManageUsersController;
use App\Http\Controllers\Admin\AdminMarketChangeController;
use App\Http\Controllers\Admin\AdminProducts;
use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerLiveOrdersController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\Customer\CustomerSubmitOrder;
use App\Http\Controllers\Customer\CustomerTransactionController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\RefreshData;
use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\AdminOrdersController;
//use App\Http\Controllers\CustomerController;

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

//admin dashboard
Route::patch("/admin",[AdminDashboardController::class,"update"])->name('admin');
Route::get("/dashboard-admin",[AdminDashboardController::class,"index"])->name("dashboard-admin");
Route::get('/market-status/{status}',[AdminDashboardController::class,'marketChange']);
Route::get('/product-status/{product}/{status}/{type}',[AdminDashboardController::class,'productChange']);
//Route::get('product-single-price/{product_id}/{buy_price}/{sell_price}',[AdminDashboardController::class,'singleProductChange']);
Route::get('/find-product/{product_id}',[AdminDashboardController::class,'findProduct']);
Route::post('/product-edit',[AdminDashboardController::class,'singleProductChange'])->name("product-edit");
Route::get("/admin-dashboard-list-products" ,[AdminDashboardController::class,"list_dashboard_products"]);


//admin live orders
Route::get('/admin-liveorders',[AdminLiveOrdersController::class,'index'])->name("admin-liveorders");
Route::post('/admin-save-order',[AdminLiveOrdersController::class,'orderSave'])->name("admin-save-order");
Route::get("/admin-list-orders" ,[AdminLiveOrdersController::class,"list_orders"]);
Route::get('/admin-liveorder-market-status/{status}',[AdminLiveOrdersController::class,'marketChange']);


//admin transaction
Route::get('/admin-transactions',[AdminTransactionsController::class,'index'])->name("admin-transactions");
Route::get("/admin-list-transactions-buy" ,[AdminTransactionsController::class,"list_transactions_buy"]);
Route::get("/admin-list-transactions-sell" ,[AdminTransactionsController::class,"list_transactions_sell"]);
Route::get('/admin-transaction-market-status/{status}',[AdminTransactionsController::class,'marketChange']);


//admin manage customers
Route::get('/admin-manage-customers',[AdminManageCustomersController::class,'index'])->name("admin-manage-customers");
Route::get('/find-customer/{customer_id}',[AdminManageCustomersController::class,'findCustomer']);
Route::get("/admin-list-customers" ,[AdminManageCustomersController::class,"list_customers"]);
Route::post('/customer-create',[AdminManageCustomersController::class,'create'])->name("customer-create");
Route::get('/admin-customers-market-status/{status}',[AdminManageCustomersController::class,'marketChange']);


//admin manage users
Route::get('/find-user/{user_id}',[AdminManageUsersController::class,'findUser']);
Route::get('/admin-manage-users',[AdminManageUsersController::class,'index'])->name("admin-manage-users");
Route::get("/admin-list-users" ,[AdminManageUsersController::class,"list_users"]);
Route::post('/user-create',[AdminManageUsersController::class,'create'])->name("user-create");
Route::get('/admin-users-market-status/{status}',[AdminManageUsersController::class,'marketChange']);


//admin market change
Route::get("/market-change-page",[AdminMarketChangeController::class,"index"])->name("market-change-page");
Route::get("/list-market-change-products" ,[AdminMarketChangeController::class,"list_marketChange_products"]);
Route::post('/market-change-product-edit',[AdminMarketChangeController::class,'singleProductChange'])->name("product-edit");
Route::get('/market-change-find-product/{product_id}',[AdminMarketChangeController::class,'findProduct']);
Route::get('/market-change-market-status/{status}',[AdminMarketChangeController::class,'marketChange']);


//admin products controller
Route::get("/admin-list-products" ,[AdminProducts::class,"list_admin_products"]);
Route::post('/product-create',[AdminProducts::class,'create_product'])->name("product-create");
Route::get('/admin-products' , [AdminProducts::class,"index"])->name("admin-products");
Route::get('/admin-products-market-status/{status}',[AdminProducts::class,'marketChange']);


////////////////////////////////////////////customer
/// customer dashboard controller
Route::get("/customer-dashboard",[CustomerDashboardController::class,"index"])->name("customer-dashboard");
Route::get("/customer-list-products" ,[CustomerDashboardController::class,"list_products"]);


/// customer transaction controller
Route::get("/customer-list-transactions-buy" ,[CustomerTransactionController::class,"list_transactions_buy"]);
Route::get("/customer-list-transactions-sell" ,[CustomerTransactionController::class,"list_transactions_sell"]);
Route::get('/customer-transactions', [CustomerTransactionController::class,'index'])->name("customer-transactions");

/// customer live order controller
Route::get("/customer-list-orders" ,[CustomerLiveOrdersController::class,"list_orders"]);
Route::get('/customer-liveorders', [CustomerLiveOrdersController::class , 'index'])->name('customer-liveorders');

///customer profile controller
Route::get('/customer-profile', [CustomerProfileController::class , 'index'])->name('customer-profile');
Route::post('/customer-edit-profile',[CustomerProfileController::class,'create'])->name("customer-edit-profile");


//refresh data after
Route::get('/update', [RefreshData::class,'getUpdatedData']);



Route::get('/order/{product}/{type}',[OrderController::class,'index']);
Route::post('/order',[CustomerSubmitOrder::class,'store'])->name('save-temp-order');
Route::get("/customer-order/{product}/{type}",[CustomerSubmitOrder::class,"index"]);

