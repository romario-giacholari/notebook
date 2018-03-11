@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <a href="/contacts" class="action-link">
                <div class="card text-white bg-primary mb-3 action-card">
                    <div class="card-header">Contacts</div>
                    <div class="card-body">
                        <h5 class="card-title">My contacts</h5>
                        <p class="card-text">{{$contacts}} contacts.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/todos" class="action-link">
                <div class="card text-white bg-success mb-3 action-card">
                    <div class="card-header">Todos</div>
                    <div class="card-body">
                        <h5 class="card-title">My todos</h5>
                        <p class="card-text">{{$todos}} uncomplete todos.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="#" class="action-link">
                <div class="card text-white bg-dark mb-3 action-card">
                    <div class="card-header">Documents</div>
                    <div class="card-body">
                        <h5 class="card-title">My documents</h5>
                        <p class="card-text">Click to view all of your documents.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/journals" class="action-link">
                <div class="card text-dark bg-light mb-3 action-card">
                    <div class="card-header">Journal</div>
                    <div class="card-body">
                        <h5 class="card-title">My journal</h5>
                        <p class="card-text">Click to view all of your entries.</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
