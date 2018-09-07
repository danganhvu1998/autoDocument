@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h1><strong> All Documents </strong></h1>
        </div>
        <div class="col-md-2">
                <a href="documents/add" class="btn btn-primary">Add document</a>
        </div>
    </div>
    <hr>
    @foreach($documents as $document)
        <div class="row">
            <div class="col-md-9 text-center">
                <a href="documents/view/{{$document->id}}">
                    <strong>{{$document->document_name}}</strong>
                </a>
            </div>
            <div class="col-md-3 text-center">
                @if (Auth::user()->level >= 99)
                    <a href="documents/delete/{{$document->id}}" class="btn btn-danger">Delete</a>
                @endif
                <a href="documents/edit/{{$document->id}}" class="btn btn-primary">Edit</a>
            </div>
        </div>
        <hr>
    @endforeach
@endsection
