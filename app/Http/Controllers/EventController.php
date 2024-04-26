<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

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

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'items_portuguese' => $items_portuguese, 'eventOwner' => $eventOwner]);
    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events;

        $guestInEvents = $user->guestInEvents;

        return view('events.dashboard', ['events' => $events, 'guestInEvents' => $guestInEvents]);
    }

    public function destroy($id) {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }

    public function edit($id) {
        
        $user = auth()->user();

        $event = Event::findOrFail($id);

        // security
        // event editing restriction to only the owner
        if($user->id != $event->user->id) {
            return redirect('/dashboard');
        }

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request) {

        $data = $request->all();

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
            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Eventos editado com sucesso');
    
    }

    public function joinEvent($id) {
        $user = auth()->user();

        $user->guestInEvents()->attach($id);

        $event = Event::findOrfail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->title);
    }

    public function leaveEvent($id) {
        $user = auth()->user();
        $user->guestInEvents()->detach($id);
        $event = Event::findOrFail($id);
        return redirect('/dashboard')->with('msg', 'Você saiu comm sucesso do evento: ' . $event->title);
    }
}