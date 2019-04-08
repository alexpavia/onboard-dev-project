@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Home</h1>
            <p>Welcome to my first Laravel app.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h3><a href="/tasks">Tasks</a></h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
