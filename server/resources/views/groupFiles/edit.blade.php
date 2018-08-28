@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>View <strong style="color:brown"> {{$groupFile->name}} </strong></h1>
        </div>
        <div class="col-md-4 btn-group">
            <a href="/groupFiles" class="btn btn-primary">All groupFiles</a>
            <a href="/groupFiles/view/{{$groupFile->id}}" class="btn btn-primary">Cancel Editing</a>
        </div>
    </div>
    {!! Form::open(['action' => 'groupFilesController@groupFilesEditing', 'method' => 'POST']) !!}
        
        {{Form::hidden("id", $groupFile->id, ['class'=>'form-control', 'placeholder'=>"Ctrl+Z to redo"])}}
        
        <h3>{{$groupFile->name}} is having ...</h3>
        <ul>
            @foreach($hasFiles as $hasFile)
                <li>
                    {{Form::checkbox($hasFile->id, 1, true)}}
                    <strong style="color:green">{{Form::label('title', $hasFile->file_url)}}<br></strong>
                </li>
            @endforeach
        </ul>
        <hr>
        
        <h3>{{$groupFile->name}} is <strong>NOT</strong> having ...</h3>
        <ul>
            @foreach($notHasFiles as $notHasFile)
                <li>
                    {{Form::checkbox($notHasFile->id, 1, false)}}
                    <strong style="color:red">{{Form::label('title', $notHasFile->file_url)}}<br></strong>
                </li>
            @endforeach
        </ul>
        <hr>
        
        {{Form::submit('Save Change', ['class' => 'btn btn-dark'])}}
    {!! Form::close() !!}
    
@endsection
