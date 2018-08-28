@extends('layouts.app')

@section('content')
    <h1><strong>Create New Group File</strong></h1>
    {!! Form::open(['action' => 'groupFilesController@groupFilesAdding', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', "Name - Requite")}}
            {{Form::text('groupFile_name', '', ['class'=>'form-control', 'placeholder'=>'Title Name'])}}
            {{Form::label('title', "Note - Optional")}}
            {{Form::textarea("groupFile_note", '', ["rows"=>"2", 'class'=>'form-control', 'placeholder'=>"Any Note?"])}}
        </div>
        {{Form::submit('Add', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection
