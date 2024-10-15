<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScreeningEventController;
use Illuminate\Support\Facades\Route;

Route::resource('movie', MovieController::class)->except(['create', 'edit']);
Route::resource('screening-event', ScreeningEventController::class)->except(['create', 'edit']);
