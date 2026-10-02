<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('logout', [SessionController::class, 'destroy'])->name('logout');
    Route::resource('expenses', ExpenseController::class)->only(['index', 'create', 'store', 'edit', 'update']);
});

Route::middleware('guest')->group(function () {
    Route::get('login', [SessionController::class, 'create'])->name('login');
    Route::post('login', [SessionController::class, 'store']);
    Route::get('register', [RegistrationController::class, 'create'])->name('register');
    Route::post('register', [RegistrationController::class, 'store']);
});