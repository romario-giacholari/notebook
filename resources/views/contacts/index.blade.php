@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center"><b>Contacts</b></h1>
        <hr />
        <contact-list :contacts="{{ json_encode($contacts) }}"> </contact-list>
        <a href="/contacts/create" class="btn btn-lg btn-success fixed-button "><i class="fa fa-plus" aria-hidden="true"></i></a>
    </div>
@endsection