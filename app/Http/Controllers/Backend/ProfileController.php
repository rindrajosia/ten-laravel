<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
      $id = Auth::user()->id;
      $user = User::find($id);

      return view('backend.users.view_profile', compact('user'));
    }

    public function edit(){
      $id = Auth::user()->id;
      $user = User::find($id);

      return view('backend.users.edit_profile', compact('user'));
    }

    public function store(Request $request){
      $data = User::find(Auth::user()->id);

      $validate = $request->validate([
        "email" => 'required|email|unique:users,email,'.$data->id,
        "name" => 'required',
        "address" => 'required',
        "gender" => 'required',
      ]);


      $data->name = $request->name;
      $data->email = $request->email;
      $data->address = $request->address;
      $data->gender = $request->gender;

      if($request->file('image')){
        $file = $request->file('image');
        @unlink(public_path('upload/user_images/'.$data->image));
        $fileName = date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('upload/user_images/'), $fileName);
        $data->image = $fileName;
      }
      $data->save();

      $notification = [
        'message' => 'Profile updated successfully',
        'alert-type' => 'success',
      ];

      return Redirect()->route('profile.view')->with($notification);
    }
}
