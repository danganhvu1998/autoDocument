@extends('layouts.app')

@section('content')
    <h1>All Employees</h1>
    @foreach ($users as $user)
        <hr>
        <div class="row">
            <div class="col-md-5 text-center">
                {{$user->name}}
            </div>
            <div class="col-md-5 text-center">
                {{$user->email}}
            </div>
            <div class="col-md-1 text-center">
                {{$user->level}}
            </div>
            <div class="col-md-1 text-center">
                <a href="/employees/view/{{$user->id}}" class="btn btn-primary">View</a>
            </div>
        </div>
    @endforeach
    <hr>
    <h1>Create New Employee</h1>
    {!! Form::open(['action' => 'employeesController@employeesAdding', 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('title', "Name - Require")}}
            {{Form::text("name", "", ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Email - Require")}}
            {{Form::text("email", "", ['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('title', "Password - Require")}}
            {{Form::text("password", "", ['class'=>'form-control'])}}
        </div>
        {{Form::submit('Create', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection
