<?php

namespace App\Http\Controllers;

use App\Journal;
use Illuminate\Http\Request;

class JournalsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $journals = Journal::where('user_id', auth()->user()->id)->latest()->get();

        if(request()->expectsJson()) {
            return $journals;
        }

        return view('journals.index', compact('journals'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'event' => 'required',
            'learned' => 'required',
            'well' => 'required',
            'better' => 'required',
            'implications' => 'required'
        ]);

        $journal = auth()->user()->journals()->create([
            'event' => $request->event,
            'learned' => $request->learned,
            'well' => $request->well,
            'better' => $request->better,
            'implications' => $request->implications
            ]);

        return $journal;
    }

    public function update(Request $request, Journal $journal)
    {
        $this->authorize('update', $journal);
        
        $journal->update([
            'event' => $request->event,
            'learned' => $request->learned,
            'well' => $request->well,
            'better' => $request->better,
            'implications' => $request->implications
            ]);

        return $journal;
    }

    public function destroy(Journal $journal)
    {
        $this->authorize('update', $journal);

        $journal->delete();
    }
}
