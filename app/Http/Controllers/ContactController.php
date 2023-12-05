<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('contacts/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:contacts',
            'contact' => 'required|string|unique:contacts',
            'address' => 'required|string'
        ]);

        $contacts = Contact::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'address' => $request->input('address')
        ]);

        return redirect('/contacts')->with('success', '.');
    }

    public function showContacts()
    {
        $contacts = Contact::all();
        return view('contacts.contacts', ['contacts' => $contacts]);
    }
}
