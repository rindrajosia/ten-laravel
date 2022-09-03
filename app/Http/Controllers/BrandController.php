<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class BrandController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $brands = Brand::latest()->paginate(2);
      return view('admin.brand.index', compact('brands'));
    }

    public function store(Request $request){
      $validated = $request->validate([
        'brand_name' => 'required|unique:brands|min:4',
        'brand_image' => 'required|mimes:jpg,jpeg,png',
      ],
      [
        'brand_name.required' => 'Please Input Brand Name',
        'brand_name.min' => 'Brand Name should be more than 4 Chars',
      ]);

      $brand_image = $request->file('brand_image');

      $name_gen = hexdec(uniqid());

      $img_ext = strtolower($brand_image->getClientOriginalExtension());

      $image_name = $name_gen.'.'.$img_ext;

      $up_location = 'image/brand/';

      Image::make($brand_image)->resize(300,200)->save($up_location.$image_name);

      Brand::insert([
        'brand_name' => $request->brand_name,
        'brand_image' => $up_location.$image_name,
        'created_at' => Carbon::now()
      ]);

      return Redirect()->back()->with('success', 'Brand Inserted Successfull');
    }

    public function edit($id){
      $brands = Brand::find($id);
      return view('admin.brand.edit', compact('brands'));
    }

    public function update(Request $request, $id){
      $validated = $request->validate([
        'brand_name' => 'required|min:4',
      ],
      [
        'brand_name.required' => 'Please Input Brand Name',
        'brand_name.min' => 'Brand Name should be more than 4 Chars',
      ]);

      $old_image = $request->old_img;
      $brand_image = $request->file('brand_image');
      if($brand_image){
        $name_gen = hexdec(uniqid());

        $img_ext = strtolower($brand_image->getClientOriginalExtension());

        $image_name = $name_gen.'.'.$img_ext;

        $up_location = 'image/brand/';

        Image::make($brand_image)->resize(300,200)->save($up_location.$image_name);

        unlink($old_image);

        Brand::find($id)->update([
          'brand_name' => $request->brand_name,
          'brand_image' => $up_location.$image_name,
          'created_at' => Carbon::now()
        ]);
      }else {
        Brand::find($id)->update([
          'brand_name' => $request->brand_name,
          'created_at' => Carbon::now()
        ]);
      }



      return Redirect()->route('all.brand')->with('success', 'Brand Updated Successfull');

    }

    public function delete($id){

      $image = Brand::find($id);
      unlink($image->brand_image);

      Brand::find($id)->delete();

      return Redirect()->back()->with('success', 'Brand deleted Successfull');

    }

    public function logout(){
      Auth::logout();
      return Redirect()->route('login')->with('success', 'Logout Successfull');
    }
}
