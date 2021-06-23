<?php

namespace App\Http\Controllers\API;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    //
    //index photo, paginate per 6 halaman
    public function index()
    {
        $photos = Photo::latest()->paginate(6);
        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data photos'
            ],
            'data' => $photos
        ],200);
    }

    //detail photo
    public function PhotoHomePage()
    {
        $photos = Photo::latest()->take(2)->get();

        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data Foto HomePage'
            ],
            'data' => $photos
        ]);
    }
}
