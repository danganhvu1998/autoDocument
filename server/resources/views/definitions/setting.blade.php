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
            <div class="col-md-2">
                ({{$definition->position}}): {{$definition->name}}
            </div>
            <div class="col-md-2">
                [[[{{$definition->define1}}]]]

            </div>
            <div class="col-md-2">
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
            <div class="col-md-3 text-center">
                @if (Auth::user()->level >= 99)
                    {!! Form::open(['action' => 'definitionsController@definitionsChangePosition', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="input-group mb-3">
                            <input type="hidden" name="currentPosition" value="{{$definition->position}}">
                            <input type="text" name="newPosition" placeholder="New Position" class="form-control">
                            {{Form::submit("Move", ['class' => 'btn btn-outline-primary'])}}
                        </div>
                    {!! Form::close() !!}
                @endif
            </div>
            
        </div>
        <hr>
    @endforeach
@endsection
