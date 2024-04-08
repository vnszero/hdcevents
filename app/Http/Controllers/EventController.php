<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// php8.3 artisan make:controller EventController
class EventController extends Controller
{
    public function index(){
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
    }

    public function create(){
        return  view('events.create');
    }
}
