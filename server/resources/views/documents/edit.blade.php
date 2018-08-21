@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>View <strong style="color:brown"> {{$document->document_name}} </strong></h1>
        </div>
        <div class="col-md-2">
            <a href="/documents" class="btn btn-primary">All Documents</a>
        </div>
        <div class="col-md-2">
            <a href="/documents/view/{{$document->id}}" class="btn btn-primary">Cancel Editing</a>
        </div>
    </div>
    {!! Form::open(['action' => 'documentsController@documentsEditing', 'method' => 'POST']) !!}
        
        {{Form::hidden("id", $document->id, ['class'=>'form-control', 'placeholder'=>"Ctrl+Z to redo"])}}
        
        <h3>{{$document->document_name}} is having ...</h3>
        <ul>
            @foreach($hasDefines as $hasDefine)
                <li>
                    {{Form::checkbox($hasDefine->id, 1, true)}}
                    <strong style="color:green">{{Form::label('title', $hasDefine->name)}}<br></strong>
                </li>
            @endforeach
        </ul>
        <hr>
        
        <h3>{{$document->document_name}} is <strong>NOT</strong> having ...</h3>
        <ul>
            @foreach($notHasDefines as $notHasDefine)
                <li>
                    {{Form::checkbox($notHasDefine->id, 1, false)}}
                    <strong style="color:red">{{Form::label('title', $notHasDefine->name)}}<br></strong>
                </li>
            @endforeach
        </ul>
        <hr>
        
        {{Form::submit('Save Change', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
    
@endsection
