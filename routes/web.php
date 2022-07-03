<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardServiceController;
use App\Http\Controllers\DashboardStylistController;
use App\Http\Controllers\DashboardCustomerController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
        ]);
    })->middleware('auth');

    Route::resource('/customers', DashboardCustomerController::class)->middleware('auth');
    
    Route::resource('/services', DashboardServiceController::class)->except(['create', 'show', 'edit'])->middleware('auth');
    
    Route::resource('/stylists  ', DashboardStylistController::class)->middleware('auth');
});
