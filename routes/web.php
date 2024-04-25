<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

// get
Route::get('/', [EventController::class, 'index']);
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
Route::get('/events/create', [EventController::class, 'create'])->middleware('auth');
Route::get('/events/edit/{id}', [Eventcontroller::class, 'edit'])->middleware('auth');
Route::get('/events/{id}', [EventController::class, 'show']);

// put
Route::put('/events/update/{id}', [EventController::class, 'update'])->middleware('auth');

// post
Route::post('/events', [EventController::class, 'store']);
Route::post('/events/join/{id}', [EventController::class, 'joinEvent'])->middleware('auth');

// delete
Route::delete('events/{id}', [EventController::class, 'destroy'])->middleware('auth');

Route::get('/contact', function () {
    return view('contact');
});