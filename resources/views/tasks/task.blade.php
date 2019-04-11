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
            @if ($mode === 'edit')
                {!! Form::model($task,['url'=>'task/edit/'.$task->id]) !!}
                @method('PATCH')
            @else
                {!! Form::model($task,['url'=>'task/new']) !!}
                @method('POST')
            @endif


            <div class="form-group">
                {!! Form::label('name', 'Task Name') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name this task']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('details', 'Details') !!}
                {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter some details']) !!}
            </div>

            <button type="submit" class="btn btn-primary float-right">Save</button>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary" role="button">Cancel</a>
            {!! Form::close() !!}

            @if ($mode === 'edit')
                {!! Form::model($task,['url'=>'task/delete/'.$task->id]) !!}
                @method('DELETE')
                <div class="mt-3">
                    <button type="submit" class="btn btn-outline-danger btn-lg btn-block">Delete</button>
                </div>
                {!! Form::close() !!}
            @endif
        </div>
    </div>

    @else
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card mb-5">
                    <div class="card-header d-flex flex-row justify-content-between">
                        <h2 class="mb-0">{{ $task->name }}</h2>
                        <small class="text-muted">Created by {{$task->createdBy}} on {{$task->updated_at->format('m/d/Y')}}</small>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <h4>Details</h4>
                            <p>{{ $task->details }}</p>
                        </div>
                        <div class="float-right">
                            <a href="/task/edit/{{$task->id}}">Edit</a>
                        </div>

                    </div>
                </div>

                <h4 class="mb-3">Notes</h4>

                @foreach ($task->notes as $note)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <p>{{$note->details}}</p>
                            <span>
                                <small class="text-muted">{{$note->createdBy}} - {{$note->updated_at->format('m/d/Y')}}</small>
                                <div class="float-right">
                                    <a href="/note/edit/{{$note->id}}">Edit</a>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="">
                    <a href="/note/create/{{$task->id}}" class="btn btn-success btn-lg btn-block">Add Note</a>
                </div>

                <div class="mt-3">
                    <a href="/tasks" class="btn btn-outline-secondary" role="button">Back to Tasks</a>

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
