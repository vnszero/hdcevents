<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $name = "Matheus";
    $age = 25;

    $arr = [10,20,30,40,50];

    $names = ['Matheus', 'Maria', 'João', 'Pedro'];

    return view('welcome', 
        [
            'name' => $name, 
            'age' => $age,
            'arr' => $arr,
            'names' => $names
        ]
    );
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/product', function () {
    return view('product');
});