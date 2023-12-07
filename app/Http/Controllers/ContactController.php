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
        
        $user = $request->user();

        $contacts = auth()->user()->contacts()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
            'address' => $request->input('address')
        ]);

        return redirect('/contacts')->with('success', '.');

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect('/contacts')->with('success', 'Contact updated successfully');
    }

    public function showContacts()
    {
        $contacts = auth()->user()->contacts;
        return view('contacts.contacts', ['contacts' => $contacts]);
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }
}
