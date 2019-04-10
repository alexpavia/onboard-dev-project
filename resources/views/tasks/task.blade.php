@extends('layouts.app')

@section('content')
<div class="container">

    @if ($mode === 'new' || $mode === 'edit')
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h2>{{$mode === 'edit' ? $task->name : 'New Task'}}</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            {!! Form::model($task,['action'=>'TasksController@updateTask']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Task Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name this task']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('details', 'Details') !!}
                {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter some details']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('noteDetails', 'Notes') !!}

                @foreach ($task->notes as $key => $note)
                {!! Form::textarea('notes['.$key.'][details]', null, ['class' => 'form-control mb-3', 'rows' => 2, 'placeholder' => 'Write a note']) !!}
                @endforeach

                <a href="#" class="btn btn-outline-info btn-lg btn-block">Add Note</a>
            </div>

            <button type="submit" class="btn btn-primary float-right">Save</button>
            <a href="/tasks" class="btn btn-outline-danger" role="button">Cancel</a>
            {!! Form::close() !!}
        </div>
    </div>

    @else
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card mb-3">
                    <div class="card-header d-flex flex-row justify-content-between">
                        <h2 class="mb-0">{{ $task->name }}</h2>
                        <small class="text-muted">Created by {{$task->createdBy}} on {{$task->created_at->format('m/d/Y')}}</small>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <h4>Details</h4>
                            <p>{{ $task->details }}</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Notes</h4>
                        @foreach ($task->notes as $note)
                        <div class="d-flex flex-column mb-2">
                            <p>{{$note->details}}</p>
                            <small class="text-muted">{{$note->createdBy}} - {{$note->created_at->format('m/d/Y')}}</small>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-3">
                    <a href="/tasks" class="btn btn-outline-secondary" role="button">Back to Tasks</a>
                    <a href="/task/edit/{{$task->id}}" class="btn btn-success float-right" role="button">Edit Task</a>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function addNote(task) {
        /*var newNote = {
            "isNew" : true,
            "details" : "",
            "user_id" : task.user_id,
            "task_id" : task.id
        };
        task.notes.push(newNote);
        console.log(task);
        return task;*/
    }
</script>
@endsection
