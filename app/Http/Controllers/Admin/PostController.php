<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:posts.index|posts.create|posts.edit|posts.delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->when(request()->keyword, function($posts){
            $posts = $posts->where('name', 'like', '%'.request()->keyword.'%');
        })->paginate(10);

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();

        return view('admin.post.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2000',
            'title' => 'required|unique:posts',
            'category_id' => 'required',
            'content' => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'slug' => Str::slug($request->title, '-'),
            'category_id' => $request->category_id,
            'content' => $request->content
        ]);

        //assign tags
        $post->tags()->attach($request->tags);
        $post->save();

        if($post){
            //redirect dengan pesan sukses
            return redirect()->route('admin.post.index')->with(['success' =>
            'Data Berhasil Disimpan!']);
        }
        else{
            return redirect()->route('admin.post.index')->with(['error' =>
            'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags = Tag::latest()->get();
        $categories = Category::latest()->get();

        return view('admin.post.edit', compact('tags', 'categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title,'.$post->id,
            'category_id' => 'required',
            'content' => 'required'
        ]);

        $post = Post::findOrFail($post->id);

        //kalo tidak ada request perubahan gambar
        if($request->file('image') == ""){
            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'content' => $request->content,
                'category_id' => $request->category_id
            ]);
        }
        else
        {
            //hapus gambar lama
            Storage::disk('local')->delete('public/posts/'.$post->image);

            //upload gambar baru
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'content' => $request->content,
                'category_id' => $request->category_id,
                'image' => $image->hashName()
            ]);

            //sync tags
            $post->tags()->sync($request->tags);

            if($post){
                //redirect dengan pesan sukses
                return redirect()->route('admin.post.index')->with(['success' =>
                'Data Berhasil Diperbarui!']);
            }
            else{
                return redirect()->route('admin.post.index')->with(['error' =>
                'Data Gagal Diperbarui!']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        Storage::disk('local')->delete('public/posts/'.$post->image);
        $post->delete();

        if($post){
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
