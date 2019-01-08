@extends('layouts.admin')

@section('content')

<!-- <h1>Categories</h1> -->

<div class="col-sm-6">
	<h2 class="text-gray-dark">Create Category</h2>
	{{Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store'])}}
		<div class="form-group">
			{{Form::label('name','Name:')}}
			{{Form::text('name',null,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
		{!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}
		</div>
	{{Form::close()}}

	<div class="row">
		@include('includes.form_error')
	</div>
</div>


<div class="col-sm-6">
	<h2 class="text-gray-dark">Categories</h2>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Category</th>
				<th>Created</th>
				<th>Updated</th>
			</tr>
		</thead>
		<tbody>
			@if($categories)
				@foreach($categories as $category)
					<tr>
						<td>{{$category->id}}</td>
						<td><a href="{{route('categories.edit',$category->id)}}">{{$category->name}}</a></td>
						<td>{{($category->created_at) ? $category->created_at->diffForHumans() : 'No date'}}</td>
						<td>{{($category->updated_at) ? $category->updated_at->diffForHumans() : 'No date'}}</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</div>

@stop