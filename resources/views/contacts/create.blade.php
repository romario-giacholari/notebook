@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><b>Add contact</b></h1>
                <hr>
                <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone_number" class="form-control" id="exampleInputPassword1" placeholder="phone number">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="gender" name="gender">
                        <option>male</option>
                        <option>female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">avatar</label>
                        <input type="file" name="avatar" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                        <small id="fileHelp" 
                            class="form-text text-muted">
                            Add an image for this contact.
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">save</button>
                </form>
            </div>
        </div>
    </div>
@endsection