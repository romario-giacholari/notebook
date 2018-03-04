@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><b>Update contact</b></h1>
                <hr>
                <form action="{{ route('contacts.update', $contact) }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PATCH')}}
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $contact->email }}" placeholder="email">
                        <small id="emailHelp" class="form-text text-muted">We'll never any email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="name" value="{{ $contact->name }}" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone_number" class="form-control" id="exampleInputPassword1" value="{{ $contact->phone_number }}" placeholder="phone number">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="gender" name="gender" value="{{ $contact->gender }}">
                        <option>male</option>
                        <option>female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">avatar</label>
                        <input type="file" name="avatar" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                        <small id="fileHelp" 
                            class="form-text text-muted">
                            Update image for this contact.
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">update</button>
                </form>
            </div>
        </div>
    </div>
@endsection