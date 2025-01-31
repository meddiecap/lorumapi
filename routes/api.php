<?php

// movies resource
Route::resource('movies', \App\Http\Controllers\MoviesController::class)->only(['index']);
