@extends('layouts.app')

@section('content')
    @if ($errorCount)
        <h1>
            <a href="/students/check/{{$student->id}}" class="text-danger">
                <strong>{{$student->name}}</strong> 
                Request Auto Document 
                ({{$errorCount}} errors)
            </a>
        </h1>    
    @else
        <h1 class="text-success">
            <strong>{{$student->name}}</strong> 
            Request Auto Document 
            ({{$errorCount}} errors)
        </h1>    
    @endif
    @foreach ($requests as $request)
        <hr>
        <div class="row">
            <div class="col-md-12 text-center">
                @if ($request->status == 0)
                    {{$request->name}} -- Pending
                @else
                    @if ($request->status == 1)
                        <strong>
                            <a href='/storage/file/{{$request->url}}' class="text-success">{{$request->name}} -- SUCCESS</a>
                        </strong>
                    @else
                        <strong class="text-danger">{{$request->name}} -- ERROR(try to request again, if still got error, inform admin)</strong>
                    @endif
                @endif
            </div>
        </div>
    @endforeach
    <hr>
    
    <!-- Register Request Form -->
    <h1>Request Document for <strong>{{$student->name}}</strong></h1>
    {!! Form::open(['action' => 'studentsController@studentsRequest', 'method' => 'POST']) !!}
        
        {{Form::hidden("id", $student->id, ['class'=>'form-control', 'placeholder'=>"Ctrl+Z to redo"])}}
        @foreach($groupFiles as $groupFile)
            <li>
                {{Form::checkbox($groupFile->id, 1, false)}}
                <strong>{{Form::label('title', $groupFile->name)}}<br></strong>
            </li>
        @endforeach
        {{Form::submit('Request Auto Document', ['class' => 'btn btn-success'])}}
    {!! Form::close() !!}
@endsection
