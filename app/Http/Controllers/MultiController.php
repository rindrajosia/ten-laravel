<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Image;

class MultiController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $images = Multipic::all();
      return view('admin.multi.index', compact('images'));
    }

    public function show(){
      $images = Multipic::all();
      return view('layouts.pages.portfolio', compact('images'));
    }

    public function store(Request $request){
      $images = $request->file('image');
      foreach ($images as $image) {
        $name_gen = hexdec(uniqid());

        $img_ext = strtolower($image->getClientOriginalExtension());

        $image_name = $name_gen.'.'.$img_ext;

        $up_location = 'image/multi/';

        Image::make($image)->resize(300,300)->save($up_location.$image_name);

        Multipic::insert([
          'image' => $up_location.$image_name,
          'created_at' => Carbon::now()
        ]);
      }
      return Redirect()->back()->with('success', 'Multiple images Inserted Successfull');
    }
}
