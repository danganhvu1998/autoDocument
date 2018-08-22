@extends('layouts.app')

@section('content')
    <!--Title-->
    <div class="row">
        <div class="col-md-7">
            <h1>Edit Note <strong style="color:brown"> {{$student->name}} </strong></h1>
        </div>
        <div class="col-md-5">
            <div class="btn-group">
                <a href="/students" class="btn btn-primary">All Students</a>
                <a href="/students/view/{{$student->id}}" class="btn btn-primary">View Student</a>
                <a href="/students/note/view/{{$student->id}}" class="btn btn-primary">View Student Note</a>
                <a href="/students/note/add/{{$student->id}}" class="btn btn-primary">Add Student Note</a>
            </div> 
        </div>
    </div>
    <hr>
    <!--Form-->
    {!! Form::open(['action' => 'studentsController@studentsNoteEditing', 'method' => 'POST']) !!}
        {{Form::hidden("student_id", $student->id, ['class'=>'form-control'])}}
        @foreach($studentNotes as $studentNote)
            <div class="form-group">
                <div class="row">
                    <div class="col-md-10">{{$studentNote->note_name}}</div>
                    <div class="col-md-2">
                        <a href="/students/note/delete/{{$student->id}}/{{$studentNote->id}}" class="text-danger">
                            Delete This Note
                        </a>
                    </div>
                        
                </div>
                {{Form::textarea($studentNote->id, $studentNote->note_value, ["rows"=>"2", 'class'=>'form-control'])}}
            </div>
        @endforeach
        {{Form::submit('Save', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
    <hr>

@endsection
