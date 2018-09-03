@extends('layouts.app')

@section('content')
    <!--Title-->
    <div class="row">
        <div class="col-md-7">
            <h1>Edit <strong style="color:brown"> {{$student->name}} </strong></h1>
        </div>
        <div class="col-md-5">
            <div class="btn-group">
                <a href="/students" class="btn btn-primary">All Students</a>
                <a href="/students/view/{{$student->id}}" class="btn btn-primary">View Student</a>
                <a href="/students/note/view/{{$student->id}}" class="btn btn-primary">Student Note</a>
            </div> 
        </div>
    </div>
    <hr>
    <!--Form-->
    {!! Form::open(['action' => 'studentsController@studentsEditing', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::hidden("id", $student->id, ['class'=>'form-control', 'placeholder'=>"Ctrl+Z to redo"])}}
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
    <hr>
    <!--Documents-->
    @foreach($documents as $document)
        <p><strong>
        @if ($errorCounts[$document->id])
            <a href="/students/document/edit/{{$document->id}}/{{$student->id}}" class="text-danger">
        @else
            <a href="/students/document/edit/{{$document->id}}/{{$student->id}}">
        @endif
            {{$document->document_name}} --> Has {{$errorCounts[$document->id]}} error[s]
        </a></strong></p>
    @endforeach
    <hr>
@endsection
