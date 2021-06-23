<?php

namespace App\Http\Controllers\API;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    //
    //index tag, paginate per 6 halaman
    public function index()
    {
        $tags = Tag::latest()->paginate(10);
        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data Tags'
            ],
            'data' => $tags
        ],200);
    }

    //detail tag
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->first();

        if($tag){
            return response()->json([
                'response' => [
                    'status' => 200,
                    'message' => 'List Data Post Berdasarkan Tags'
                ],
                'data' => $tag->posts()->latest()->paginate(6)
            ],200);
        }
        else{
            return response()->json([
                'response' => [
                    'status' => 404,
                    'message' => 'Tag is not exist'
                ],
                'data' => null
            ], 404);
        }
    }
}
