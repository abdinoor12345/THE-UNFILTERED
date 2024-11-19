<?php

namespace App\Http\Controllers;

use App\Mail\ReplyToContact;
use App\Models\Contact;
use Auth;
use Illuminate\Http\Request;
use Mail;

class Contactcontroller extends Controller
{
    public function create(){
        return view('Contact.Contact Us');
    }
    public function store(Request $request){
        $user=Auth::user();
$contact=$request->validate(
    [
        'name'=>'string|required|max:255',
        'email'=>'email|string|max:255|required',
        'message'=>'string|required|max:700',
    ]);
    $contact['user_id']=$user->id;

    Contact::create($contact);
    return redirect()->back()->with('success','Contact Submitted succefully.');
    }
    public function index(){
        $contacts=Contact::all();
        return view('Contact.ContactData',compact('contacts'));
    }
    public function reply($id)
{
    $contact = Contact::findOrFail($id);
    return view('Contact.reply', compact('contact'));
}

public function sendReply(Request $request, $id)
{
    $request->validate([
        'message' => 'required',
    ]);

    $contact = Contact::findOrFail($id);

    Mail::to($contact->email)->send(new ReplyToContact($request->message));

    return redirect()->route('contact')->with('success', 'Reply sent successfully.');
}
}
