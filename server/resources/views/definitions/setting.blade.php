@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1><strong> Definitions </strong></h1>
        </div>
        <div class="col-md-2">
            <a href="/definitions/add" class="btn btn-primary">Add Definition</a>
        </div>
    </div>
    @foreach($definitions as $definition)
        <div class="row">
            <div class="col-md-3">
                {{$definition->name}}
            </div>
            <div class="col-md-3">
                [[[{{$definition->define1}}]]]

            </div>
            <div class="col-md-3">
                [[[{{$definition->define2}}]]]
            </div>
            <div class="col-md-3">
                <div class="btn-group">
                    <a href="/definitions/changePos/up/{{$definition->position}}" class="btn btn-success"> UP </a>
                    <a href="/definitions/changePos/down/{{$definition->position}}" class="btn btn-info">DOWN</a>
                </div>
                <div class="btn-group">
                    <a href="/definitions/delete/{{$definition->id}}" class="btn btn-danger">Delete</a>
                    <a href="/definitions/edit/{{$definition->id}}" class="btn btn-primary">Edit</a>
                </div>
            </div>
            
        </div>
        <hr>
    @endforeach
@endsection
