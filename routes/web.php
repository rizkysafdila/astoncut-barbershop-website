<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardServiceController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardStylistController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\CustomerReservationController;
use App\Http\Controllers\DashboardTransactionController;

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
            'customers' => Customer::with('service', 'stylist')->get(),
            'confirmed_amount' => Customer::where('status', '=', 2)->count(),
            'pending_amount' => Customer::where('status', '=', 1)->count(),
            'canceled_amount' => Customer::where('status', '=', 3)->count(),
            'change_time_amount' => Customer::where('status', '=', 4)->count(),
        ]);
    })->middleware('auth');

    Route::resource('/my-reservations', CustomerReservationController::class)->except(['show', 'edit'])->middleware('customer');
    Route::put('/my-reservations', [CustomerReservationController::class, 'updateStatus'])->middleware('customer');
    
    Route::resource('/customers', DashboardCustomerController::class)->except('show')->middleware('auth');
    Route::put('/customers', [DashboardCustomerController::class, 'updateStatus'])->middleware('auth');

    Route::get('/transactions', [DashboardTransactionController::class, 'index'])->middleware('auth');
    Route::post('/transactions', [DashboardTransactionController::class, 'store'])->middleware('auth');
    Route::put('/transactions', [DashboardTransactionController::class, 'updateStatus'])->middleware('auth');
    
    Route::resource('/services', DashboardServiceController::class)->except(['create', 'show', 'edit'])->middleware('auth');
    
    Route::resource('/stylists', DashboardStylistController::class)->except(['create', 'show', 'edit'])->middleware('auth');

    Route::get('/settings', [DashboardSettingController::class, 'index'])->middleware('auth');
});