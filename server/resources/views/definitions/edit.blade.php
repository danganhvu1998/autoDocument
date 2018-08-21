@extends('layouts.app')

@section('content')
    <h1><strong>Edit Definition</strong></h1>
    {!! Form::open(['action' => 'definitionsController@definitionsEditing', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::hidden('id', $definition->id, ['class'=>'form-control', 'placeholder'=>''])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Name - Requite")}}
            {{Form::text('name', $definition->name, ['class'=>'form-control', 'placeholder'=>'Title Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Define 1 - Requite")}}
            {{Form::text('define1', $definition->define1, ['class'=>'form-control', 'placeholder'=>'Title Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Define 2 - Optional")}}
            {{Form::text('define2', $definition->define2, ['class'=>'form-control', 'placeholder'=>'Title Name'])}}
        </div>
        {{Form::submit('Change', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection
