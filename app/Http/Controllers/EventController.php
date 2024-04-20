<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    
    public function index() {

        $events = Event::all();
    
        return view('welcome',['events' => $events]);

    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {

        $event = new Event;

        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            //recover from form hash
            $requestImage = $request->image;
            $extension = $requestImage->extension();

            // set a unique name based in file name and time
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            
            // store in a exclusive path just for this images
            $request->image->move(public_path('img/events'), $imageName);

            // prepare to save a link in database
            $event->image = $imageName;
        }

        $event->save();

        return redirect('/')->with('msg', 'Evento Criado com Sucesso!');

    }

}