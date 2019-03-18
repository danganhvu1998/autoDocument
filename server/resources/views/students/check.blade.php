@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>Check <strong style="color:brown"> {{$student->name}} </strong>Information </h1>
        </div>
        <div class="col-md-2">
            <a href="/students" class="btn btn-primary">All Students</a>
        </div>
        <div class="col-md-2">
            <a href="/students/edit/{{$student->id}}" class="btn btn-primary">Edit Student</a>
        </div>
    </div>
    <hr>
    @if ($errorInfos)
        @foreach($errorInfos as $errorInfo)
            <div class="row">
                <div class="col-md-5">
                    <strong class="text-danger">
                        {{$errorInfo->document_name}} -> {{$errorInfo->name}}
                    </strong>
                </div>
                <div class="col-md-7">
                    "<strong class="text-danger">{{$errorInfo->value}}</strong>"
                     <-> 
                    "<strong>{{$errorInfo->origin_value}}</strong>"
                </div>
            </div>
            <hr>
        @endforeach
        <br><br><br><br><br><br>
        <div class="text-center">
            <a href="/students/request/{{$student->id}}" class="btn btn-lg btn-danger">
                JUST IGNORE AND GO TO REQUEST SITE
            </a>
        </div>
    @else
        <br><br><br><br><br><br>
        <div class="text-center">
            <a href="/students/request/{{$student->id}}" class="btn btn-lg btn-success">
                Finally! Let't CHEER and request AUTO DOCUMENT!
            </a>
        </div>
    @endif
@endsection
