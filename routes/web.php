<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavingController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');

    Route::get('/budget', [BudgetController::class, 'index'])->name('budget.index');
    Route::post('/budget', [BudgetController::class, 'update'])->name('budget.update');

    Route::get('/savings', [SavingController::class, 'index'])->name('savings.index');
    Route::get('/savings/create', [SavingController::class, 'create'])->name('savings.create');
    Route::post('/savings', [SavingController::class, 'store'])->name('savings.store');
    Route::get('/savings/{saving}/edit', [SavingController::class, 'edit'])->name('savings.edit');
    Route::put('/savings/{saving}', [SavingController::class, 'update'])->name('savings.update');
    Route::delete('/savings/{saving}', [SavingController::class, 'destroy'])->name('savings.destroy');
    
});

require __DIR__.'/auth.php';
