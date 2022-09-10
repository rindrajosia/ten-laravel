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

      return Redirect()->route('contact')->with('success', 'Message sent Successfull');
    }

    public function delete($id){
      ContactForm::find($id)->delete();
      return Redirect()->route('admin.message')->with('success', 'Message removed Successfull');
    }
}
