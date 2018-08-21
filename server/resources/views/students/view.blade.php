@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>View <strong style="color:brown"> {{$student->name}} </strong>Information </h1>
        </div>
        <div class="col-md-2">
            <a href="/students" class="btn btn-primary">All Students</a>
        </div>
        <div class="col-md-2">
            <a href="/students/edit/{{$student->id}}" class="btn btn-primary">Edit Student</a>
        </div>
    </div>
    <p><strong>Note:</strong> {{$student->note}}</p>
    <hr>
    @foreach($assignments as $assignment)
        <div class="row">
            <div class="col-md-4">
                <strong>{{$assignment->name}}:</strong>
            </div>
            <div class="col-md-8">
                {{$assignment->value}}
            </div>
        </div>
        <hr>
    @endforeach
    @foreach($documents as $document)
        <p><strong><a href="/students/document/view/{{$document->id}}/{{$student->id}}">
            {{$document->document_name}}
        </a></strong></p>
    @endforeach
    <hr>
@endsection
