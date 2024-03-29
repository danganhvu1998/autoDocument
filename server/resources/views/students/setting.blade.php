@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1><strong> Students </strong></h1>
        </div>
        <div class="col-md-2">
                <a href="students/add" class="btn btn-primary">Add Student</a>
        </div>
    </div>
    <hr>
    @foreach($students as $student)
        <div class="row">
            <div class="col-md-1 text-center">
                {{$student->id}}
            </div>
            <div class="col-md-3 text-center">
                <a href="/students/view/{{$student->id}}">{{$student->name}}</a>
            </div>
            <div class="col-md-5 text-center">
                {{$student->note}}
            </div>

            <div class="col-md-3 text-center btn-group">
                <a href="students/edit/{{$student->id}}" class="btn btn-primary">Edit</a>
                <a href="students/request/{{$student->id}}" class="btn btn-success">Request</a>
                <!--<a href="students/delete/{{$student->id}}" class="btn btn-danger">Delete</a>-->
            </div>
        </div>
        <hr>
    @endforeach
@endsection
