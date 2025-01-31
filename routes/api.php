<?php

// movies resource
Route::resource('movies', \App\Http\Controllers\MoviesController::class)->only(['index']);

// genres resource
Route::resource('genres', \App\Http\Controllers\GenreController::class)->only(['index']);
