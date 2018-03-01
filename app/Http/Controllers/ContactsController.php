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
        return Contact::paginate(25);
    }

    public function show(Contact $contact)
    {
        return $contact;
    }

    public function store(Request $request)
    {
        auth()->user()->saveContact([
            'name' => $request->name
        ]);
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update([
            'name' => $request->name
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
    }
}
