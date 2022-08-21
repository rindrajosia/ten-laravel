<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
      $categories = DB::Table('categories')->latest()->get();

      return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request){
      $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:255',
      ],
      [
        'category_name.required' => 'Please Input Category Name',
        'category_name.max' => 'Category Name should be less 255 Chars',
      ]);
      Category::insert([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now()
      ]);

      return Redirect()->back()->with('success', 'Category Inserted Successfull');
    }
}
