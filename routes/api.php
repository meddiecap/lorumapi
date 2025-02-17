<?php

// movies resource
Route::resource('movies', \App\Http\Controllers\MoviesController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// genres resource
Route::resource('genres', \App\Http\Controllers\GenreController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// directors resource
Route::resource('directors', \App\Http\Controllers\DirectorController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
