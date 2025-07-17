<?php

// movies resource
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\Faker\ApiController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

// movies resource
Route::resource('movies', MoviesController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// genres resource
Route::resource('genres', GenreController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// directors resource
Route::resource('directors', DirectorController::class)->only(['index', 'show', 'store', 'update', 'destroy']);


Route::get('faker/list-resources', [ApiController::class, 'listResources'])->name('faker.list');
Route::get('faker/{resource}', [ApiController::class, 'index'])->name('faker.index');

