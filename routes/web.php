<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

// get
Route::get('/', [EventController::class, 'index']);
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

// post
Route::post('/events', [EventController::class, 'store']);

// delete
Route::delete('events/{id}', [EventController::class, 'destroy']);

Route::get('/contact', function () {
    return view('contact');
});