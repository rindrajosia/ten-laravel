<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function changePassword(){
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
        return Redirect()->route('login')->with('success', 'Password updated Successfull');
      }else{
        return Redirect()->back()->with('error', 'Current Password is Invalid');
      }

    }
}
