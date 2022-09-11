<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index(){
      return view('admin.body.change_password');
    }

    public function update(Request $request){
      $validated = $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed'
      ]);

      $hashedPassword = Auth::user()->password;

      if(Hash::check($request->current_password, $hashedPassword)){
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        $notification = [
          'message' => 'Password updated Successfully',
          'alert-type' => 'success'
        ];
        return Redirect()->route('login')->with($notification);
      }else{
        $notification = [
          'message' => 'Current Password is Invalid',
          'alert-type' => 'error'
        ];
        return Redirect()->back()->with($notification);
      }

    }
}
