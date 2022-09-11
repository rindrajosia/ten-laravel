<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class MessageController extends Controller
{
    public function index(){
      $messages = ContactForm::all();
      return view('admin.message.index', compact('messages'));
    }

    public function store(Request $request){
      ContactForm::insert([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
        'created_at' => Carbon::now()
      ]);

      $notification = [
        'message' => 'Message sent Successfully',
        'alert-type' => 'success'
      ];

      return Redirect()->route('contact')->with($notification);
    }

    public function delete($id){
      ContactForm::find($id)->delete();
      $notification = [
        'message' => 'Message removed Successfully',
        'alert-type' => 'warning'
      ];
      return Redirect()->route('admin.message')->with($notification);
    }
}
