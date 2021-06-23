<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //
    //index category, paginate per 6 halaman
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return response()->json([
            'response' => [
                'status' => 200,
                'message' => 'List Data Kategori'
            ],
            'data' => $categories
        ],200);
    }

    //detail category
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->first();

        if($category){
            return response()->json([
                'response' => [
                    'status' => 200,
                    'message' => 'List Data Post Berdasarkan Kategori'
                ],
                'data' => $category->posts()->latest()->paginate(6)
            ],200);
        }
        else{
            return response()->json([
                'response' => [
                    'status' => 404,
                    'message' => 'Kategori is not exist'
                ],
                'data' => null
            ], 404);
        }
    }
}
