<?php

use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Home');
})
    ->name('home')
    ->middleware(['auth']);

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('incomes', IncomeController::class)
    ->only(['index', 'create', 'store'])
    ->middleware(['auth']);

require __DIR__ . '/settings.php';
