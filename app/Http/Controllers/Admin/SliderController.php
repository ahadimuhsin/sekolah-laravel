<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:sliders.index|sliders.create|sliders.delete']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = Slider::latest()->when(request()->keyword, function($sliders){
            $sliders = $sliders->where('name', 'like', '%'.request()->keyword.'%');
        })->paginate(10);
        // dd($sliders);

        return view('admin.slider.index', compact('sliders'));
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
            'image' => 'required|image',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/sliders', $image->hashName());

        $slider = Slider::create([
            'image' => $image->hashName()
        ]);

        if($slider){
            //redirect dengan pesan sukses
            return redirect()->route('admin.slider.index')->with(['success' =>
            'Data Berhasil Disimpan!']);
        }
        else{
            return redirect()->route('admin.slider.index')->with(['error' =>
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
        $slider = Slider::findOrFail($id);
        // dd($slider->foto);
        // Storage::disk('public')->delete($slider->image);
        // dd('public/sliders/'.$slider->image);
        Storage::disk('local')->delete('public/sliders/'.$slider->image);

        $slider->delete();

        if($slider){
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
