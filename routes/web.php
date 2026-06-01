<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RestaurantAuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantReportController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::middleware(['auth', \App\Http\Middleware\PreventCaching::class])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/user/profile', function () {
        return view('user.profile');
    })->name('user.profile');

    
    Route::resource('patients', PatientController::class);
    
    Route::resource('doctors', DoctorController::class);
    

    Route::get('/appointments/daily', [AppointmentController::class, 'daily'])->name('appointments.daily');
    Route::resource('appointments', AppointmentController::class);
    
    Route::get('/reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
});

// ==================== RESTAURANT MANAGEMENT SYSTEM ====================

// Restaurant Authentication Routes
Route::prefix('restaurant')->name('restaurant.')->group(function () {
    Route::middleware('guest:restaurant')->group(function () {
        Route::get('/login', [RestaurantAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [RestaurantAuthController::class, 'login'])->name('login.submit');
        Route::get('/register', [RestaurantAuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [RestaurantAuthController::class, 'register'])->name('register.submit');
    });

    Route::post('/logout', [RestaurantAuthController::class, 'logout'])
        ->middleware('auth:restaurant')->name('logout');
});

// Restaurant Management Routes (Protected)
Route::prefix('restaurant')->name('restaurant.')->middleware('auth:restaurant')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('restaurant.dashboard');
    })->name('dashboard');

    // Menu Management
    Route::resource('menu', MenuController::class);

    // Customer Management
    Route::resource('customers', CustomerController::class);

    // Order Management
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{order}/items', [OrderController::class, 'addItem'])->name('orders.addItem');
    Route::delete('/order-items/{orderDetail}', [OrderController::class, 'removeItem'])->name('order-items.remove');

    // Reports
    Route::get('/reports/daily-revenue', [RestaurantReportController::class, 'dailyRevenue'])
        ->name('reports.daily-revenue');
    Route::get('/reports/monthly-revenue', [RestaurantReportController::class, 'monthlyRevenue'])
        ->name('reports.monthly-revenue');
    Route::get('/reports/revenue-by-item', [RestaurantReportController::class, 'revenueByItem'])
        ->name('reports.revenue-by-item');
    Route::get('/reports/export-daily/{date}', [RestaurantReportController::class, 'exportDailyRevenue'])
        ->name('reports.export-daily');
});



