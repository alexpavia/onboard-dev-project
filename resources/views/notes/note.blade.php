@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h1>{{$note->task->name}}</h1>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($mode === 'edit')
                {!! Form::model($note,['url'=>'note/edit/'.$note->id]) !!}
                @method('PATCH')
            @else
                {!! Form::model($note,['url'=>'note/new']) !!}
                @method('POST')
                {{ Form::hidden('taskId', $note->task->id) }}
            @endif

            <div class="form-group">
                <div class="d-flex flex-row justify-content-between">
                    <h5>Note Details</h5>
                    @if ($mode === 'edit')
                    <small class="text-muted float-right">Last updated {{$note->updated_at->format('m/d/Y')}}</small>
                    @endif
                </div>

                {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Write a note']) !!}
            </div>

            <div class="d-flex">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mr-auto">Cancel</a>
                <button type="submit" class="btn btn-primary ml-3">Save</button>
            </div>
            {!! Form::close() !!}


            @if ($mode !== 'new')
                {!! Form::model($note,['url'=>'note/delete/'.$note->id]) !!}
                @method('DELETE')
                {{ Form::hidden('taskId', $note->task->id) }}
                <div class="mt-3">
                    <button type="submit" class="btn btn-outline-danger btn-lg btn-block">Delete</button>
                </div>
                {!! Form::close() !!}
            @endif
        </div>
    </div>
</div>
@endsection
