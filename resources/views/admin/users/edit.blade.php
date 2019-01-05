@extends('layouts.admin')

@section('content')

<h1>Edit User</h1>

<div class="row">
	<div class="col-sm-3">
		<img height="200" class="img-responsive img-rounded" src="{{$user->image_placeholder()}}" alt="">
	</div>

	<div class="col-sm-9">
		{{Form::model($user,['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],'files'=>true])}}

		<div class="form-group">
			{{Form::label('name','Name:')}}
			{{Form::text('name',$user->name,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::label('email','Email:')}}
			{{Form::email('email',$user->email,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::label('role_id','Role:')}}
			{{Form::select('role_id',$roles,null,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::label('is_active','Status:')}}
			{{Form::select('is_active',[0=>'Not Active',1=>'active'],null,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			{{Form::label('file','Profile Photo:')}}
			{{Form::file('file')}}
		</div>
		<div class="form-group">
			{{Form::label('password','Password:')}}
			{{Form::password('password',['class'=>'form-control'])}}
		</div>
		<div class="form-group">
		{!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}
		</div>

		{{Form::close()}}
 	</div>

</div>

<div class="row">
 	@include('includes.form_error')
</div>

@stop