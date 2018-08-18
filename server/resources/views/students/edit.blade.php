@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1>Edit <strong style="color:brown"> {{$student->name}} </strong>Information </h1>
        </div>
        <div class="col-md-2">
            <a href="/students/view/{{$student->id}}" class="btn btn-primary">Cancel Editing</a>
        </div>
    </div>
    <hr>
    {!! Form::open(['action' => 'studentsController@studentsEditing', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', "Student ID - Do not touch unless you know what it is!")}}
            {{Form::text("id", $student->id, ['class'=>'form-control', 'placeholder'=>"Ctrl+Z to redo"])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Student nickname - Require")}}
            {{Form::text("name", $student->name, ['class'=>'form-control', 'placeholder'=>"How you call your student?"])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Note - Optional")}}
            {{Form::textarea("note", $student->note, ["rows"=>"2", 'class'=>'form-control', 'placeholder'=>"Any Note?"])}}
        </div>
        @foreach($assignments as $assignment)
            <div class="form-group">
                {{Form::label('title', $assignment->name." - Optional")}}
                {{Form::text($assignment->define_id, $assignment->value, ['class'=>'form-control', 'placeholder'=>$assignment->define1])}}
            </div>
        @endforeach
        {{Form::submit('Save', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
@endsection
