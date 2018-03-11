@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center"><b>Todos</b></h1>
        <hr />
        <todos :todos="{{ json_encode($todos)}}"></todos>
    </div>
@endsection