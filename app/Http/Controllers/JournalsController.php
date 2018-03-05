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

        return view('journals.index', compact('journals'));
    }

    public function store(Request $request)
    {
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
    }

    public function destroy(Journal $journal)
    {
        $this->authorize('update', $journal);

        $journal->delete();
    }
}
