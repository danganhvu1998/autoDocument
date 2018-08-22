@extends('layouts.app')

@section('content')
    <!--Title-->
    <div class="row">
        <div class="col-md-7">
            <h1>View Note <strong style="color:brown"> {{$student->name}} </strong></h1>
        </div>
        <div class="col-md-5">
            <div class="btn-group">
                <a href="/students" class="btn btn-primary">All Students</a>
                <a href="/students/view/{{$student->id}}" class="btn btn-primary">View Student</a>
                <a href="/students/note/edit/{{$student->id}}" class="btn btn-primary">Edit Student Note</a>
            </div> 
        </div>
    </div>
    <hr>
    <!--Form-->
    @foreach($studentNotes as $studentNote)
        <div class="row">
            <div class="col-md-4">
                <strong>{{$studentNote->note_name}}:</strong>
            </div>
            <div class="col-md-8">
                {{$studentNote->note_value}}
            </div>
        </div>
        <hr>
    @endforeach

@endsection
