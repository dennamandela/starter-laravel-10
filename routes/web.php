<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

// proses login
Route::post('/login', [AuthController::class, 'authentication'])
    ->name('login.auth');

// root redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/expense-voucher', [ExpenseController::class, 'index'])
        ->name('expense-voucher');

    // 🔥 CREATE HARUS DI ATAS
    Route::get('/expense-voucher/create', [ExpenseController::class, 'create'])
        ->name('expense-voucher.create');

    Route::post('/expense-voucher/store', [ExpenseController::class, 'store'])
        ->name('expense-voucher.store');

    Route::get('/expense-voucher/{id}/print', [ExpenseController::class, 'print'])
        ->name('expense-voucher.print');

    Route::get('/expense-voucher/{id}', [ExpenseController::class, 'show'])
        ->name('expense-voucher.show');

    Route::get('/expense-voucher/{id}/edit', [ExpenseController::class, 'edit'])
        ->name('expense-voucher.edit');

    Route::put('/expense-voucher/{id}/update', [ExpenseController::class, 'update'])
        ->name('expense-voucher.update');

    Route::delete('/expense-voucher/{id}', [ExpenseController::class, 'destroy'])
        ->name('expense-voucher.destroy');
});