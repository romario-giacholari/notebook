<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Contact::where('user_id', auth()->user()->id)->get();

        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:25',
        ]);

        $contact = auth()->user()->saveContact($request->all());
        
        return redirect($contact->path())->with('flash','Saved!');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);

        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $this->validate($request, [
            'name' => 'required|max:25',
        ]);

        $contact->update($request->all());

        return redirect($contact->path())->with('flash', 'Updated!');
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact->delete();

        return redirect(route('contacts.index'))->with('flash','Deleted!');
    }
}
