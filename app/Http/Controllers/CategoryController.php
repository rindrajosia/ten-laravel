<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
      return view('admin.category.index');
    }

    public function store(Request $request){
      $validated = $request->validate([
        'category_name' => 'required|unique:categories|max:255',
      ],
      [
        'category_name.required' => 'Please Input Category Name',
        'category_name.max' => 'Category Name should be less 255 Chars',
      ]);
    }
}
