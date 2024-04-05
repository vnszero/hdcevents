<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $name = "Matheus";
    $age = 25;
    return view('welcome', ['name' => $name, 'age' => $age]);
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/product', function () {
    return view('product');
});