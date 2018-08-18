@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1><strong style="color:brown"> {{$student->name}} </strong>Information </h1>
        </div>
        <div class="col-md-2">
            <a href="/students/edit/{{$student->id}}" class="btn btn-primary">Edit Student</a>
        </div>
    </div>
    <p><strong>Note:</strong> {{$student->note}}</p>
    <hr>
    @foreach($assignments as $assignment)
        <div class="row">
            <div class="col-md-3">
                <strong>{{$assignment->name}}:</strong>
            </div>
            <div class="col-md-3">
                {{$assignment->value}}
            </div>
        </div>
        <hr>
    @endforeach
@endsection
