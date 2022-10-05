<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index(){
      $data['users'] = User::all();
      return view('backend.users.index', $data);
    }

    public function create(){
      return view('backend.users.create');
    }

    public function store(Request $request){
      $validate = $request->validate([
        "email" => 'required|unique:users',
        "name" => 'required',
        "role" => 'required',
      ]);

      $data = new User();
      $data->role = $request->role;
      $data->email = $request->email;
      $data->name = $request->name;
      $data->password = Hash::make($request->password);
      $data->save();

      $notification = [
        'message' => 'User inserted successfully',
        'alert-type' => 'success',
      ];

      return Redirect()->route('users.view')->with($notification);
    }

    public function edit($id){
      $user = User::find($id);
      return view('backend.users.edit', compact('user'));
    }

    public function update(Request $request, $id){
      $validate = $request->validate([
        "email" => 'required|email|unique:users,email,'.$id,
        "name" => 'required',
        "role" => 'required',
      ]);

      $user = User::find($id)->update([
        'role' => $request->role,
        'email' => $request->email,
        'name' => $request->name,
      ]);


      $notification = [
        'message' => 'User updated successfully',
        'alert-type' => 'info',
      ];

      return Redirect()->route('users.view')->with($notification);
    }

    public function delete($id){
      if(Auth::user()->id != $id) {
        $user = User::find($id)->delete();
        $notification = [
          'message' => 'User removed successfully',
          'alert-type' => 'info',
        ];
      } else {
        $notification = [
          'message' => 'You cannot removed logged in user',
          'alert-type' => 'warning',
        ];
      }

      return Redirect()->route('users.view')->with($notification);
    }
}
