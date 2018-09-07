@extends('layouts.app')

@section('content')
    <h1>Employee <strong>{{$user->name}}</strong></h1>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12"> Name: </div>
                <div class="col-md-12"> <strong>{{$user->name}}</strong> </div>
                <hr>
                <div class="col-md-12"> Email: </div>
                <div class="col-md-12"> <strong>{{$user->email}}</strong> </div>
                <hr>
            </div>
        </div>
        <div class="col-md-4">
            {!! Form::open(['action' => 'employeesController@employeesEdit', 'method' => 'POST']) !!}
                {{Form::hidden("employee_id", $user->id, ['class'=>'form-control'])}}
                <div class="form-group">
                    {{Form::label('title', "Level(1-2-99)")}}
                    {{Form::text("level", "", ['class'=>'form-control', 'placeholder' => $user->level])}}
                </div>
                {{Form::submit('Change', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
    <hr>
    <!--Students List-->
    <h2>Students List</h2>
    @foreach ($students as $student)
        <div class="row">
            <div class="col-md-3 text-center">
                {{$student->name}}
            </div>
            <div class="col-md-6 text-center">
                {{$student->note}}
            </div>
            <div class="col-md-3 text-center">
                <div class="btn-group">
                    <a class="btn btn-success" href="/students/check/{{$student->student_id}}">Check</a>
                    <a class="btn btn-danger" href="/employees/rmStudent/{{$student->user_id}}/{{$student->student_id}}">Remove</a>
                </div>
            </div>
        </div>
    @endforeach
    {!! Form::open(['action' => 'employeesController@employeesAddStudent', 'method' => 'POST']) !!}
        {{Form::hidden("employee_id", $user->id, ['class'=>'form-control'])}}
        <div class="form-group">
            {{Form::label('title', "Add student to employee")}}
            {{Form::number("student_id", "", ['class'=>'form-control', 'placeholder' => "Student ID"])}}
        </div>
        {{Form::submit('Add', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection