@extends('layouts.app')

@section('content')
    <h1><strong>Create New Definition</strong></h1>
    {!! Form::open(['action' => 'definitionsController@definitionsAdding', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', "Name - Requite")}}
            {{Form::text('name', '', ['class'=>'form-control', 'placeholder'=>'Title Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Define 1 - Requite")}}
            {{Form::text('define1', '', ['class'=>'form-control', 'placeholder'=>'Title Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Define 2 - Optional")}}
            {{Form::text('define2', '', ['class'=>'form-control', 'placeholder'=>'Title Name'])}}
        </div>
        {{Form::submit('Add', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection
