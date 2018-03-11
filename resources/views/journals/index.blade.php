@extends('layouts.app')
@section('content')

    <journals :journals="{{ json_encode($journals) }}"></journals>
    
@endsection