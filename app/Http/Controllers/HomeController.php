<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::where([
            ['user_id' ,auth()->user()->id],
            ['completed', false]
        ])->count();

        $contacts = Contact::where('user_id', auth()->user()->id)->count();

        return view('home', [
            'todos' => $todos,
            'contacts' => $contacts
        ]);
    }
}
