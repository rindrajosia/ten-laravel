<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }
    
    public function index(){

      $categories = Category::latest()->paginate(2);
      $trashCat = Category::onlyTrashed()->latest()->paginate(2);

      return view('admin.category.index', compact('categories', 'trashCat'));
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

    public function edit($id){
      $categories = Category::find($id);
      return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request, $id){
      $update = Category::find($id)->update([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
      ]);
      return Redirect()->route('all.category')->with('success', 'Category Updated Successfull');
    }

    public function softDelete($id){
      $delete = Category::find($id)->delete();
      return Redirect()->back()->with('success', 'Category Soft Deleted Successfull');

    }

    public function restore($id){
      $delete = Category::withTrashed()->find($id)->restore();
      return Redirect()->back()->with('success', 'Category restored Successfull');

    }

    public function remove($id){
      $delete = Category::onlyTrashed()->find($id)->forceDelete();
      return Redirect()->back()->with('success', 'Category Permanantly removed');

    }
}
