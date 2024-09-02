<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');
Route::post('customers/search', [CustomerController::class, 'search'])->name('customers.search');

