<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get sliders
        $sliders = Slider::latest()->get();
        $navitem = 'slider';
        $navitemchild = '';

        //render view with posts
        return view('sliders.index', compact('sliders', 'navitem', 'navitemchild'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $navitem = 'slider';
        $navitemchild = '';

        // render view
        return view('sliders.create', compact('navitem', 'navitemchild'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'max:100',
            'description' => '',
        ]);

        //upload image
        $image = $request->file('image');
        $imageName = $image->hashName();

        // resize image agar serasi
        $imagePath = 'assets-landing/img/slide/' . $imageName;
        Image::make($image)
            ->resize(1920, 1088)
            ->save(public_path($imagePath));

        //create slider
        Slider::create([
            'image' => $imageName,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        //redirect to index
        return redirect()->route('sliders.index')->with(['success' => 'Data Slider Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        $navitem = 'slider';
        $navitemchild = '';

        //return view
        return view('sliders.show', compact('slider', 'navitem', 'navitemchild'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $navitem = 'slider';
        $navitemchild = '';

        // return view
        return view('sliders.edit', compact('slider', 'navitem', 'navitemchild'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //validate form
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'max:100',
            'description' => '',
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $imageName = $image->hashName();

            // resize image agar serasi
            $imagePath = 'assets-landing/img/slide/' . $imageName;
            Image::make($image)
                ->resize(1920, 1088)
                ->save(public_path($imagePath));

            //delete old image
            $oldImagePath = public_path('assets-landing/img/slide/' . $slider->image);
            File::delete($oldImagePath);

            //update product with new image
            $slider->update([
                'image' => $imageName,
                'title' => $request->title,
                'description' => $request->description,
            ]);
        } else {
            //update slider without image
            $slider->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }

        //redirect to index
        return redirect()->route('sliders.index')->with(['success' => 'Data Slider Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //delete image
        $oldImagePath = public_path('assets-landing/img/slide/' . $slider->image);
        File::delete($oldImagePath);

        //delete product
        $slider->delete();
        //redirect to index
        return redirect()->route('sliders.index')->with(['success' => 'Data Slider Berhasil Dihapus!']);
    }
}
