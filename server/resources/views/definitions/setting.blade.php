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
            <div class="col-md-3 text-center">
                {{$definition->name}}
            </div>
            <div class="col-md-3 text-center">
                [[[{{$definition->define1}}]]]

            </div>
            <div class="col-md-3 text-center">
                [[[{{$definition->define2}}]]]
            </div>
            <div class="col-md-3 text-center">
                @if (Auth::user()->level >= 99)
                    <div class="btn-group">
                        <a href="/definitions/changePos/up/{{$definition->position}}" class="btn btn-success"> UP </a>
                        <a href="/definitions/changePos/down/{{$definition->position}}" class="btn btn-info">DOWN</a>
                    </div>
                    <div class="btn-group">
                        <a href="/definitions/delete/{{$definition->id}}" class="btn btn-danger">Delete</a>    
                        <a href="/definitions/edit/{{$definition->id}}" class="btn btn-primary">Edit</a>
                    </div>
                @endif
            </div>
            
        </div>
        <hr>
    @endforeach
@endsection
