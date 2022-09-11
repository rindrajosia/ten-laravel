<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index(){
      $contacts = Contact::all();
      return view('admin.contact.index', compact('contacts'));
    }

    public function create(){
      return view('admin.contact.create');
    }

    public function show(){
      $contact = DB::table('contacts')->first();
      return view('layouts.pages.contact', compact('contact'));
    }

    public function store(Request $request){
      $validated = $request->validate([
        'email' => 'required|unique:contacts|email',
        'phone' => 'required|unique:contacts|digits:10',
        'address' => 'required|unique:contacts',
      ]);

      Contact::insert([
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'created_at' => Carbon::now()
      ]);

      $notification = [
        'message' => 'Contact Inserted Successfully',
        'alert-type' => 'success'
      ];

      return Redirect()->route('admin.contact')->with($notification);
    }

    public function edit($id){
      $contact = Contact::find($id);
      return view('admin.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id){
      $validated = $request->validate([
        'email' => 'required|email',
        'phone' => 'required|digits:10',
        'address' => 'required',
      ]);

      Contact::find($id)->update([
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
      ]);

      $notification = [
        'message' => 'Contact Updated Successfully',
        'alert-type' => 'info'
      ];

      return Redirect()->route('admin.contact')->with($notification);
    }

    public function delete($id){
      Contact::find($id)->delete();
      $notification = [
        'message' => 'Contact removed Successfully',
        'alert-type' => 'warning'
      ];
      return Redirect()->route('admin.contact')->with->with($notification);
    }

}
