@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center"><strong>Journals</strong></h1> 
    <hr />
    <div class="row">
    @foreach($journals as $journal)
        <div class="col-md-12">
            <dl class="row">
                <dt class="col-sm-3">Event</dt>
                <dd class="col-sm-9"> {{ $journal->event }}</dd>

                <dt class="col-sm-3">What did I learn?</dt>
                <dd class="col-sm-9">
                    <p> {{ $journal->learned }} </p>
                </dd>

                <dt class="col-sm-3">What went well?</dt>
                <dd class="col-sm-9">
                    <p> {{ $journal->well }} </p>
                </dd>

                <dt class="col-sm-3">What could I have done better?</dt>
                <dd class="col-sm-9"> 
                    <p> {{ $journal->better }} </p>
                </dd>

                <dt class="col-sm-3">Implications</dt>
                <dd class="col-sm-9"> 
                    <p> {{ $journal->implications }}</p>
                </dd>
            </dl>
        </div>
    @endforeach
    </div>
</div>
@endsection