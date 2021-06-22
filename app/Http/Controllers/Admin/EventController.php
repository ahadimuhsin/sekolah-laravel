<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['permission:events.index|events.create|events.edit|events.delete']);
    }

    public function index()
    {
        $events = Event::latest()->when(request()->keyword, function($events){
            $events = $events->where('title', 'like', '%'.request()->keyword.'%');
        })->paginate(10);

        return view('admin.event.index', compact('events'));
    }

    public function create(){
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'location' => 'required',
            'date' => 'required'
        ]);

        $event = Event::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'location' => $request->location,
            'date' => $request->date
        ]);

        if($event){
            //redirect dengan pesan sukses
            return redirect()->route('admin.event.index')->with(['success' =>
            'Data Berhasil Disimpan!']);
        }
        else{
            return redirect()->route('admin.event.index')->with(['error' =>
            'Data Gagal Disimpan!']);
        }
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'location' => 'required',
            'date' => 'required'
        ]);

        $event = Event::findOrFail($event->id);
        $event->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'content' => $request->content,
            'location' => $request->location,
            'date' => $request->date
        ]);

        if($event){
            //redirect dengan pesan sukses
            return redirect()->route('admin.event.index')->with(['success' =>
            'Data Berhasil Diperbarui!']);
        }
        else{
            return redirect()->route('admin.event.index')->with(['error' =>
            'Data Gagal Diperbarui!']);
        }
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        if($event){
            return response()->json([
                'status' => 'success'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

}
