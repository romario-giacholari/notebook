@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img src="{{ asset($contact->avatar) }}" class="contact-avatar" />
            </div>
            <div class="col-md-10">
                <div><b> {{ $contact->name }} </b></div>
                <small class="form-text text-muted"> {{ $contact->gender }}</small>
                <div> <i class="fa fa-envelope-o" aria-hidden="true"></i> {{ $contact->email }}</div>
                <div> <i class="fa fa-phone" aria-hidden="true"></i> {{ $contact->phone_number }}</div>
                <a href=" {{ route('contacts.edit', $contact) }}" class="btn btn-outline-success mr-1 mt-2 float-left"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <form action="{{route('contacts.destroy',$contact)}}" method="POST">
                        {{method_field('DELETE')}}
                        {{csrf_field()}}
                        <button class="btn btn-outline-danger mr-1 mt-2"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
                <hr />
                <conversations :conversation=" {{ json_encode($contact->conversations) }}" :contact=" {{ json_encode($contact) }}"></conversations>

            </div>
        </div>
    </div>
@endsection