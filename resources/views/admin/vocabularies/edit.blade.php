@extends('layouts.admin');

@section('content')
<h1 class="text-center">Edit vocabulary</h1>
<div class="col-sm-6">
	{{Form::model($vocabulary,['method'=>'PATCH','action'=>['AdminVocabulariesController@update',$vocabulary->id]])}}
		<div class="form-group">
			{{Form::label('name','Vocabulary:')}}
			{{Form::text('name',$vocabulary->name,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{!! Form::submit('Update vocabulary',['class'=>'btn btn-primary col-sm-6']) !!}
		</div>
	{{Form::close()}}
	{{Form::open(['method'=>'DELETE','action'=>['AdminVocabulariesController@destroy',$vocabulary->id]])}}
		<div class="form-group">
			{!! Form::submit('Delete vocabulary',['class'=>'btn btn-danger col-sm-6']) !!}
		</div>
	{{Form::close()}}
</div>
@stop