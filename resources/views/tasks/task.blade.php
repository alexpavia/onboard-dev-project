@extends('layouts.app')

@section('content')
<div class="container">

    @if ($mode === 'new')
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2>New Task</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="/tasks">
                @csrf

                <div class="form-group">
                    <label for="name">Task Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter a name for your task">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter some details" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Notes</label>
                    <input type="text" class="form-control mb-1" name="noteName" placeholder="Name this note">
                    <textarea class="form-control mb-3" name="noteDescription" placeholder="Enter note details" rows="2"></textarea>
                    <!--<button type="button" name="addNote" id="addNote" class="btn btn-outline-info btn-lg btn-block">Add Note</button>-->
                </div>

                <button type="submit" class="btn btn-primary float-right">Save</button>
                <a href="/tasks" class="btn btn-outline-danger" role="button">Cancel</a>
            </form>
        </div>
    </div>

    @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>{{ $task->name }}</h2>
                <p>{{ $task->description }}</p>

                @foreach ($task->notesDetails as $note)
                <div class="card">
                    <div class="card-header">
                        {{$note->name}}
                        <small class="float-right text-muted">Created by {{$note->createdBy}} on {{$note->created_at->format('d/m/Y')}}</small>
                    </div>
                    <div class="card-body">
                        {{$note->description}}
                    </div>
                </div>
                @endforeach

                <div class="mt-3">
                    <a href="/tasks" class="btn btn-outline-secondary" role="button">Back to Tasks</a>
                    <!--<a href="#" class="btn btn-success float-right" role="button">Edit Task</a>-->
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
