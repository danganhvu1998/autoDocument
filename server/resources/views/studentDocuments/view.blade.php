@extends('layouts.app')

@section('content')
    <!--Title-->
    <div class="row">
        <div class="col-md-7">
            <h1>
                Edit 
                <strong style="color:brown"> 
                    {{$student->name}}-{{$document->document_name}} 
                </strong>
            </h1>
        </div>
        <div class="col-md-5">
            <div class="btn-group">
                <a href="/students" class="btn btn-primary">All Students</a>
                <a href="/students/view/{{$student->id}}" class="btn btn-primary">View Student</a>
                <a href="/students/document/edit/{{$document->id}}/{{$student->id}}" class="btn btn-primary">Edit</a>
            </div> 
        </div>
    </div>
    <hr>
    <!--Form-->
    @foreach($assignStudentDocuments as $assignStudentDocument)
        <div class="row">
            <div class="col-md-4">
                <strong>{{$assignStudentDocument->name}}:</strong>
            </div>
            <div class="col-md-8">
                {{$assignStudentDocument->value}}
            </div>
        </div>
        <hr>
    @endforeach

@endsection
