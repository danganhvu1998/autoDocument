@extends('layouts.app')

@section('content')
    <!--Title-->
    <div class="row">
        <div class="col-md-7">
            <h1>Add Note <strong style="color:brown"> {{$student->name}} </strong></h1>
        </div>
        <div class="col-md-5">
            <div class="btn-group">
                <a href="/students" class="btn btn-primary">All Students</a>
                <a href="/students/view/{{$student->id}}" class="btn btn-primary">View Student</a>
                <a href="/students/note/view/{{$student->id}}" class="btn btn-primary">View Student Note</a>
                <a href="/students/note/edit/{{$student->id}}" class="btn btn-primary">Edit Student Note</a>
            </div> 
        </div>
    </div>
    <hr>
    <!--Form-->
    {!! Form::open(['action' => 'studentsController@studentsNoteAdding', 'method' => 'POST']) !!}
        {{Form::hidden("student_id", $student->id, ['class'=>'form-control'])}}
        <div class="form-group">
            {{Form::label('title', "Note Name")}}
            {{Form::text("note_name", "", ['class'=>'form-control'])}}
        </div>
        {{Form::submit('Save', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
    <hr>

@endsection
