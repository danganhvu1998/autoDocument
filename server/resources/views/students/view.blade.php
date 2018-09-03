@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <h1>View <strong style="color:brown"> {{$student->name}} </strong>Information </h1>
        </div>
        <div class="col-md-5">
            <div class="btn-group">
                <a href="/students" class="btn btn-primary">All Students</a>
                <a href="/students/edit/{{$student->id}}" class="btn btn-primary">Edit Student</a>
                <a href="/students/note/view/{{$student->id}}" class="btn btn-primary">Student Note</a>
                <a href="/students/check/{{$student->id}}" class="btn btn-primary">Check Student</a>
            </div> 
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
        <p><strong>
        @if ($errorCounts[$document->id])
            <a href="/students/document/view/{{$document->id}}/{{$student->id}}" class="text-danger">
        @else
            <a href="/students/document/view/{{$document->id}}/{{$student->id}}">
        @endif
            {{$document->document_name}} --> Has {{$errorCounts[$document->id]}} error[s]
        </a></strong></p>
    @endforeach
    <hr>
@endsection
