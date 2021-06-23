<?php

namespace App\Http\Controllers\API;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    //index video, paginate per 6 halaman
    public function index()
    {
        $videos = Video::latest()->paginate(4);
        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data Video'
            ],
            'data' => $videos
        ],200);
    }

    //detail video
    public function VideoHomePage()
    {
        $videos = Video::latest()->take(2)->get();

        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data Video HomePage'
            ],
            'data' => $videos
        ]);
    }
}
