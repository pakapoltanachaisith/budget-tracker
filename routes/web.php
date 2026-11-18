<?php

use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
    Route::resource('incomes', IncomeController::class)->only(['index']);
});

require __DIR__ . '/settings.php';
