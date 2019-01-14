@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

	<h1 class="text-center">Edit Post</h1>

<div class="row">
		<div class="form-group thumbnail">
			<img height="200" class="img-thumbnail" width="300" src="{{$post->image_placeholder()}}" alt="">
		</div>
	
		{{Form::model($post,['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id],'files'=>true])}}

		<div class="form-group">
			{{Form::label('title','Title:')}}
			{{Form::text('title',null,['class'=>'form-control'])}}
		</div>

		<div class="form-group">
			{{Form::label('category_id','Category:')}}
			{{Form::select('category_id',$categories,null,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::label('photo_id','Photo:')}}
			{{Form::file('photo_id',null,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::label('body','Description:')}}
			{{Form::textarea('body',null,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
		{!! Form::submit('Update Post',['class'=>'btn btn-primary col-sm-6']) !!}
		</div>

	{{Form::close()}}

	{{Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]])}}
		<div class="form-group">
		{!! Form::submit('Delete Post',['class'=>'btn btn-danger col-sm-6']) !!}
		</div>
	{{Form::close()}}
</div>

	<div class="row">
			@include('includes.form_error')
	</div>
<hr>
@stop