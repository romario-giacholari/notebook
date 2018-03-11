@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
             <a href="/contacts/create" class="btn btn-lg btn-success add-button mr-auto"><i class="fa fa-plus" aria-hidden="true"></i></a>
             <h1 class="mr-auto"><strong>Contacts</strong></h1> 
        </div>
        <hr />
        <contact-list :contacts="{{ json_encode($contacts) }}"> </contact-list>
      
    </div>
@endsection