<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['permission:tags.index|tags.create|tags.edit|tags.delete']);
    }

    public function index()
    {
        $tags = Tag::latest()->when(request()->keyword, function($tags){
            $tags = $tags->where('name', 'like', '%'.request()->keyword.'%');
        })->paginate(10);

        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name'
        ]);

        $tag = Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-')
        ]);

        if($tag){
            //redirect dengan pesan sukses
            return redirect()->route('admin.tag.index')->with(['success' =>
            'Data Berhasil Disimpan!']);
        }
        else{
            return redirect()->route('admin.tag.index')->with(['error' =>
            'Data Gagal Disimpan!']);
        }

    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name,'.$tag->id
        ]);

        $tag = Tag::findOrFail($tag->id);
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-')
        ]);

        if($tag){
            //redirect dengan pesan sukses
            return redirect()->route('admin.user.index')->with(['success' =>
            'Data Berhasil Diperbarui!']);
        }
        else{
            return redirect()->route('admin.user.index')->with(['error' =>
            'Data Gagal Diperbarui!']);
        }
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        if($tag){
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
