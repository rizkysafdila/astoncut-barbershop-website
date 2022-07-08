<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardServiceController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardStylistController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\CustomerReservationController;
use App\Http\Controllers\DashboardPaymentMethodController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('home', [
        'title' => "Home"
    ]);
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'customers' => Customer::with('service', 'stylist')->latest()->get(),
            'confirmed_amount' => Customer::where('status', '=', 2)->count(),
            'pending_amount' => Customer::where('status', '=', 1)->count(),
            'canceled_amount' => Customer::where('status', '=', 3)->count(),
            'change_time_amount' => Customer::where('status', '=', 4)->count(),
        ]);
    })->middleware('auth');

    Route::resource('/my-reservations', CustomerReservationController::class)->except(['show', 'edit', 'destroy'])->middleware('customer');
    Route::put('/my-reservations', [CustomerReservationController::class, 'update'])->middleware('customer');
    Route::put('/my-reservations', [CustomerReservationController::class, 'updateStatus'])->middleware('customer');
    
    Route::resource('/customers', DashboardCustomerController::class)->except('show')->middleware('admin');
    Route::put('/customers', [DashboardCustomerController::class, 'updateStatus'])->middleware('admin');

    Route::get('/transactions', [DashboardTransactionController::class, 'index'])->middleware('admin');
    Route::post('/transactions', [DashboardTransactionController::class, 'store'])->middleware('admin');
    Route::put('/transactions', [DashboardTransactionController::class, 'updateStatus'])->middleware('admin');
    
    Route::resource('/services', DashboardServiceController::class)->except(['create', 'show', 'edit'])->middleware('admin');
    
    Route::resource('/stylists', DashboardStylistController::class)->except(['create', 'show', 'edit'])->middleware('admin');

    Route::get('/settings', [DashboardSettingController::class, 'index'])->middleware('auth');
    
    Route::post('/payment-method', [DashboardPaymentMethodController::class, 'store'])->middleware('admin');
    Route::put('/payment-method', [DashboardPaymentMethodController::class, 'update'])->middleware('admin');
    Route::post('/delete-payment-method', [DashboardPaymentMethodController::class, 'destroy'])->middleware('admin');

    Route::put('/update-password', [UserController::class, 'updatePassword'])->middleware('auth');
});