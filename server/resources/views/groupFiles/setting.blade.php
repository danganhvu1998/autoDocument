@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1><strong> All groupFiles </strong></h1>
        </div>
        <div class="col-md-2">
                <a href="groupFiles/add" class="btn btn-primary">Add groupFile</a>
        </div>
    </div>
    <hr>
    @foreach($groupFiles as $groupFile)
        <div class="row">
            <div class="col-md-3 text-center">
                <a href="groupFiles/view/{{$groupFile->id}}">
                    <strong>{{$groupFile->name}}</strong>
                </a>
            </div>
            <div class="col-md-7 text-center">
                {{$groupFile->note}}
            </div>
            <div class="col-md-2 text-center">
                @if (Auth::user()->level >= 99)
                    <a href="groupFiles/edit/{{$groupFile->id}}" class="btn btn-primary">Edit</a>
                    <a href="groupFiles/delete/{{$groupFile->id}}" class="btn btn-danger">Delete</a>
                @endif
            </div>
        </div>
        <hr>
    @endforeach
@endsection
