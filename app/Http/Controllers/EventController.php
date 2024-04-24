<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    
    public function index() {

        
        $search = request("search");
        
        if($search) {
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        } else {
            $events = Event::all();
        }

        return view('welcome',['events' => $events, 'search' => $search]);

    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {

        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

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

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento Criado com Sucesso!');

    }

    public function show($id) {
        $items_portuguese = ["Cadeiras", "Palco", "Bebida", "Comida", "Brindes"];
        $event = Event::findOrFail($id);
        return view('events.show', ['event' => $event, 'items_portuguese' => $items_portuguese]);
    }
}