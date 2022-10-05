<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class PasswordController extends Controller
{
    public function index(){
      return view('backend.users.edit_password');
    }

    public function update(Request $request){
      $validate = $request->validate([
        "current_password" => 'required',
        "password" => 'required|confirmed',
      ]);

      $hashPassword = Auth::user()->password;

      if(Hash::check($request->current_password, $hashPassword)){
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        return redirect()->route('login');
      }else {
        return redirect()->back();
      }
    }
}
