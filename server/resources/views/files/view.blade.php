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
		<a href='/storage/file/{{$file->file_url}}'>
		    {{$file->file_url}}
				</a>
			</div>
			<div class="col-md-7">
				/storage/file/{{$file->file_url}}
			</div>
			<div class="col-md-1">
				@if (Auth::user()->level >= 99)
					<a href="/files/delete/{{$file->id}}" class="btn btn-danger">delete</a>
				@endif
			</div>
	</div>
	<hr>
	@endforeach
@endsection
