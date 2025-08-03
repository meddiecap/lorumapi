<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FakerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/documentation', [HomeController::class, 'documentation'])->name('documentation');
Route::get('/faker', [FakerController::class, 'index'])->name('faker');
Route::get('/faker/{resource}', [FakerController::class, 'resource'])->name('faker.resource');
