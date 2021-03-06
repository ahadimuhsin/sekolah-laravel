<?php

namespace App\Http\Controllers\API;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    //
    public function index()
    {
        $events = Event::latest()->paginate(4);
        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data events'
            ],
            'data' => $events
        ],200);
    }

    //detail event
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->first();

        if($event){
            return response()->json([
                'response' => [
                    'status' => 200,
                    'message' => 'List Data events'
                ],
                'data' => $event
            ],200);
        }
        else{
            return response()->json([
                'response' => [
                    'status' => 404,
                    'message' => 'event is not exist'
                ],
                'data' => null
            ], 404);
        }
    }

    //menampilkan 6 event terbaru
    public function EventHomePage()
    {
        $events = Event::latest()->take(5)->get();

        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data events'
            ],
            'data' => $events
        ],200);
    }
}
