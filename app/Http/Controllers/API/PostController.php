<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //index post, paginate per 6 halaman
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data Posts'
            ],
            'data' => $posts
        ],200);
    }

    //detail post
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if($post){
            return response()->json([
                'response' => [
                    'status' => 200,
                    'message' => 'List Data Posts'
                ],
                'data' => $post
            ],200);
        }
        else{
            return response()->json([
                'response' => [
                    'status' => 404,
                    'message' => 'Post is not exist'
                ],
                'data' => null
            ], 404);
        }
    }

    //menampilkan 6 post terbaru
    public function PostHomePage()
    {
        $posts = Post::latest()->take(6)->get();

        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data Posts'
            ],
            'data' => $posts
        ],200);
    }
}
