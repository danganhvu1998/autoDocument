@extends('layouts.app')

@section('content')
    <h1><strong>Create New Student</strong></h1>
    {!! Form::open(['action' => 'studentsController@studentsAdding', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', "Student nickname - Require")}}
            {{Form::text("name", '', ['class'=>'form-control', 'placeholder'=>"How you call your student?"])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Note - Optional")}}
            {{Form::textarea("note", '', ["rows"=>"2", 'class'=>'form-control', 'placeholder'=>"Any Note?"])}}
        </div>
        @foreach($definitions as $definition)
            <div class="form-group">
                {{Form::label('title', $definition->name." - Optional")}}
                {{Form::text($definition->id, '', ['class'=>'form-control', 'placeholder'=>$definition->define1])}}
            </div>
        @endforeach
        {{Form::submit('Add Student', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection
