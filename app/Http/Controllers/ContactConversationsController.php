<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Conversation;
use Illuminate\Http\Request;

class ContactConversationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contact $contact)
    {
        return $contact->conversations;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Contact $contact)
    {
        $this->validate($request, [
            'topic' => 'required',
            'body' => 'required'
        ]);

        $conversation = $contact->conversations()->create($request->all());

        return $conversation;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact, Conversation $conversation)
    {
        $this->validate($request, [
            'topic' => 'required',
            'body' => 'required'
        ]);

        $conversation->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact, Conversation $conversation)
    {

        $conversation->delete();
    }
}
