<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
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
        'brand_name.max' => 'Brand Name should be more than 4 Chars',
      ]);

      $brand_image = $request->file('brand_image');

      $name_gen = hexdec(uniqid());

      $img_ext = strtolower($brand_image->getClientOriginalExtension());

      $image_name = $name_gen.'.'.$img_ext;

      $up_location = 'image/brand/';

      $brand_image->move($up_location, $image_name);

      Brand::insert([
        'brand_name' => $request->brand_name,
        'brand_image' => $up_location.$image_name,
        'created_at' => Carbon::now()
      ]);

      return Redirect()->back()->with('success', 'Brand Inserted Successfull');
    }
}
