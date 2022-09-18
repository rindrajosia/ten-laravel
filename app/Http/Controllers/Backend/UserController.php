<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function store(Request $requet){
      $validate = $requet->validate([
        "email" => 'required|unique:users',
        "name" => 'required',
        "role" => 'required',
      ]);

      $data = new User();
      $data->role = $requet->role;
      $data->email = $requet->email;
      $data->name = $requet->name;
      $data->password = bcrypt($requet->password);
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

    public function update(Request $requet, $id){
      $validate = $requet->validate([
        "email" => 'required|email|unique:users,email,'.$id,
        "name" => 'required',
        "role" => 'required',
      ]);

      $user = User::find($id)->update([
        'role' => $requet->role,
        'email' => $requet->email,
        'name' => $requet->name,
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
