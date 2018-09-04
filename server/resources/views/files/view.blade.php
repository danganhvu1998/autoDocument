@extends('layouts.app')

@section('content')
	<h1><strong>Upload New File</strong></h1>
	{!! Form::open(['action' => 'filesController@filesAdding', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        {{Form::file('file')}}
		{{Form::submit('UPLOAD (Maximum 2MB)', ['class' => 'btn btn-dark'])}}
	{!! Form::close() !!}
	<hr>

	<!--End Form, Stast list-->
	@if(count($files)==0)
        <h1><strong>NO files HERE</strong></h1>
	@endif
	
	@foreach($files as $file)
        <div class="row">
            <div class="col-md-4">
                <a href='http://kyatod.sciencet:8000/storage/file/{{$file->file_url}}'>
                    {{$file->file_url}}
				</a>
			</div>
			<div class="col-md-7">
				http://kyatod.sciencet:8000/storage/file/{{$file->file_url}}
			</div>
			<div class="col-md-1">
				<a href="/files/delete/{{$file->id}}">
					<button class="btn btn-primary">delete</button>
				</a>
			</div>
        </div>
        <hr>
	@endforeach
@endsection
