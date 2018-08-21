@extends('layouts.app')

@section('content')
    <!--Title-->
    <div class="row">
        <div class="col-md-8">
            <h1>
                Edit 
                <strong style="color:brown"> 
                    {{$student->name}}-{{$document->document_name}} 
                </strong>
            </h1>
        </div>
        <div class="col-md-2">
            <a href="/students/view/{{$student->id}}" class="btn btn-primary">View This Student</a>
        </div>
        <div class="col-md-2">
            <a href="/students/document/view/{{$document->id}}/{{$student->id}}" class="btn btn-primary">Cancel Editing</a>
        </div>
    </div>
    <hr>
    <!--Form-->
    {!! Form::open(['action' => 'studentsController@studentsDocumentEditing', 'method' => 'POST']) !!}
        {{Form::hidden("student_id", $student->id, ['class'=>'form-control'])}}
        {{Form::hidden("document_id", $document->id, ['class'=>'form-control'])}}
        @foreach($assignStudentDocuments as $assignStudentDocument)
            <div class="form-group">
                {{Form::label('title', $assignStudentDocument->name)}}
                {{Form::text($assignStudentDocument->id, $assignStudentDocument->value, ['class'=>'form-control'])}}
            </div>
        @endforeach
        {{Form::submit('Save', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
    <hr>

@endsection
