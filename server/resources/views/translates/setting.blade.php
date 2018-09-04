@extends('layouts.app')

@section('content')
    <!--Title-->
    <h1>All Translations</h1>
    <hr>
    <!--Form-->
    {!! Form::open(['action' => 'translationsController@translationsSetting', 'method' => 'POST']) !!}
        {{Form::hidden("translate_id", $id, ['class'=>'form-control'])}}
        @if ($id==0)
            {{Form::text("vietnamese", "", ['class'=>'form-control', 'placeholder'=>"VIETNAMESE"])}}
            {{Form::text("japanese", "", ['class'=>'form-control', 'placeholder'=>"JAPANESE"])}}
            {{Form::submit('Add Translation', ['class' => 'btn btn-primary'])}}    
        @else
            {{Form::text("vietnamese", $translateEdit->vietnamese, ['class'=>'form-control', 'placeholder'=>"VIETNAMESE"])}}
            {{Form::text("japanese", $translateEdit->japanese, ['class'=>'form-control', 'placeholder'=>"JAPANESE"])}}
            {{Form::submit('Edit Translation', ['class' => 'btn btn-primary'])}}
        @endif
    {!! Form::close() !!}
    <hr>
    <!--Show-->
    @foreach($translates as $translate)
        <div class="row">
            <div class="col-md-5 text-center">
                {{$translate->vietnamese}}
            </div>
            <div class="col-md-5 text-center">
                {{$translate->japanese}}
            </div>
            <div class="col-md-2 text-center">
                <a href="/translations/{{$translate->id}}" class="btn btn-primary">Edit</a>
            </div>
        </div>
        <hr>
    @endforeach

@endsection
