@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <h1>View <strong style="color:brown"> {{$groupFile->name}} </strong></h1>
        </div>
        <div class="col-md-4 btn-group">
            <a href="/groupFiles" class="btn btn-primary">All groupFiles</a>
            <a href="/groupFiles/edit/{{$groupFile->id}}" class="btn btn-primary">Edit groupFile</a>
        </div>
    </div>

    <h3>{{$groupFile->name}} is having ...</h3>
    <ul>
        @foreach($hasFiles as $hasFile)
            <li><strong style="color:green">{{$hasFile->file_url}}<br></strong></li>
        @endforeach
    </ul>
    <hr>
    
    <h3>{{$groupFile->name}} is <strong>NOT</strong> having ...</h3>
    <ul>
        @foreach($notHasFiles as $notHasFile)
            <li><strong style="color:red">{{$notHasFile->file_url}}<br></strong></li>
        @endforeach
    </ul>
    <hr>
    
@endsection
