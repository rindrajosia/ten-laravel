<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class SliderController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $sliders = Slider::latest()->get();
      return view('admin.slider.index', compact('sliders'));
    }

    public function create(){
      return view('admin.slider.create');
    }

    public function store(Request $request){
      $validated = $request->validate([
        'title' => 'required|unique:sliders|min:4',
        'description' => 'required|min:10',
        'image' => 'required|mimes:jpg,jpeg,png',
      ]);

      $image = $request->file('image');

      $name_gen = hexdec(uniqid());

      $img_ext = strtolower($image->getClientOriginalExtension());

      $image_name = $name_gen.'.'.$img_ext;

      $up_location = 'image/slider/';

      Image::make($image)->resize(1920,1088)->save($up_location.$image_name);

      Slider::insert([
        'title' => $request->title,
        'description' => $request->description,
        'image' => $up_location.$image_name,
        'created_at' => Carbon::now()
      ]);

      return Redirect()->route('home.slider')->with('success', 'Slide Inserted Successfull');
    }

    public function edit($id){
      $slide = Slider::find($id);
      return view('admin.slider.edit', compact('slide'));
    }

    public function update(Request $request, $id){
      $validated = $request->validate([
        'title' => 'required|min:4',
        'description' => 'required|min:10',
      ]);
      $old_img = $request->old_img;
      $image = $request->file('image');

      if($image){
        $name_gen = hexdec(uniqid());

        $img_ext = strtolower($image->getClientOriginalExtension());

        $image_name = $name_gen.'.'.$img_ext;

        $up_location = 'image/slider/';

        Image::make($image)->resize(1920,1088)->save($up_location.$image_name);

        unlink($old_img);

        Slider::find($id)->update([
          'title' => $request->title,
          'description' => $request->description,
          'image' => $up_location.$image_name,
        ]);

      } else {

        Slider::find($id)->update([
          'title' => $request->title,
          'description' => $request->description,
        ]);
      }
      return Redirect()->route('home.slider')->with('success', 'Slide Updated Successfull');
    }

    public function delete($id){
      $image = Slider::find($id);
      unlink($image->image);

      Slider::find($id)->delete();

      return Redirect()->back()->with('success', 'Slide deleted Successfull');
    }
}
