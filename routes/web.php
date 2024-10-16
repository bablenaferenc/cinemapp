<?php

use App\Models\Movie;
use App\Models\ScreeningEvent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $movies = Movie::all();
    $screenings = ScreeningEvent::all();

    return view('welcome', compact('movies', 'screenings'));
});
