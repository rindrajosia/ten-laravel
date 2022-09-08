<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Carbon;
use Auth;

class AboutController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $abouts = About::latest()->get();
      return view('admin.about.index', compact('abouts'));
    }

    public function create(){
      return view('admin.about.create');
    }

    public function store(Request $request){
      $validated = $request->validate([
        'title' => 'required|unique:sliders|min:4',
        'short_description' => 'required|min:10',
        'long_description' => 'required|min:50',
      ]);

      About::insert([
        'title' => $request->title,
        'short_description' => $request->short_description,
        'long_description' => $request->long_description,
        'created_at' => Carbon::now()
      ]);

      return Redirect()->route('home.about')->with('success', 'About Inserted Successfull');
    }

    public function edit($id){
      $about = About::find($id);
      return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id){
      $validated = $request->validate([
        'title' => 'required|unique:sliders|min:4',
        'short_description' => 'required|min:10',
        'long_description' => 'required|min:50',
      ]);

      About::find($id)->update([
        'title' => $request->title,
        'short_description' => $request->short_description,
        'long_description' => $request->long_description,
        'created_at' => Carbon::now()
      ]);

      return Redirect()->route('home.about')->with('success', 'About Updated Successfull');
    }

    public function delete($id){
      About::find($id)->delete();
      return Redirect()->route('home.about')->with('success', 'About removed Successfull');
    }
}
