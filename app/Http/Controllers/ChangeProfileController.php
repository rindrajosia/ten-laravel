<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class ChangeProfileController extends Controller
{
    public function index(){
      if(Auth::user()){
        $user = User::find(Auth::user()->id);
        if($user){
          return view('admin.body.change_profile', compact('user'));
        }
      }
      Auth::logout();
      $notification = [
        'message' => 'Please logged in',
        'alert-type' => 'error'
      ];
      return Redirect()->route('login')->with($notification);
    }

    public function update(Request $request){
      $user = User::find(Auth::user()->id);
      if($user){
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        $notification = [
          'message' => 'Profile updated Successfully',
          'alert-type' => 'success'
        ];
        return Redirect()->back()->with($notification);
      }else{
        $notification = [
          'message' => 'Profile was not updated',
          'alert-type' => 'warning'
        ];
        return Redirect()->back()->with($notification);
      }

    }
}
