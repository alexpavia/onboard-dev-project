@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h1>Tasks</h1>
        </div>
    </div>
    @if (!$tasks->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <a href="task/edit/new" class="btn btn-success float-right" role="button">Add New Task</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table" style="background-color:#fff;">
                    <thead>
                    <tr>
                        <th scope="col">Task ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Details</th>
                        <th scope="col">Created</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td><a href="/task/{{$task->id}}">{{ $task->name }}</a></td>
                        <td>{{ $task->details }}</td>
                        <td>{{ $task->created_at->format('m/d/Y - g:i A') }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                You have no tasks! Try <a href="/task/edit/new">creating a new one</a>.
            </div>
        </div>
    @endif
</div>
@endsection
