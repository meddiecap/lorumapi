<?php

// movies resource
Route::resource('movies', \App\Http\Controllers\Movies::class)->only(['index']);
