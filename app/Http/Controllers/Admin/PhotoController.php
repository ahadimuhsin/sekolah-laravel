<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:photos.index|photos.create|photos.delete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::latest()->when(request()->keyword, function($photos){
            $photos = $photos->where('caption', 'like', '%'.request()->keyword.'%');
        })->paginate(10);

        return view('admin.photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'caption' => 'required',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/photos', $image->hashName());

        $photo = Photo::create([
            'image' => $image->hashName(),
            'caption' => $request->caption
        ]);

        if($photo){
            //redirect dengan pesan sukses
            return redirect()->route('admin.photo.index')->with(['success' =>
            'Data Berhasil Disimpan!']);
        }
        else{
            return redirect()->route('admin.photo.index')->with(['error' =>
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $photo = Photo::findOrFail($id);
        Storage::disk('local')->delete('public/photos/'.$photo->image);
        $photo->delete();

        if($photo){
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
