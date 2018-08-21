@extends('layouts.app')

@section('content')
    <h1><strong>Create New Document</strong></h1>
    {!! Form::open(['action' => 'documentsController@documentsAdding', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', "Name - Requite")}}
            {{Form::text('document_name', '', ['class'=>'form-control', 'placeholder'=>'Title Name'])}}
        </div>
        {{Form::submit('Add', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection
