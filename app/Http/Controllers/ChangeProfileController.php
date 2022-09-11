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
      return Redirect()->route('login');
    }

    public function update(Request $request){
      $user = User::find(Auth::user()->id);
      if($user){
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        return Redirect()->back()->with('success', 'Profile updated Successfull');
      }else{
        return Redirect()->back();
      }

    }
}
