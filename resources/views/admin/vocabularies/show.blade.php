@extends('layouts.admin');

@section('content')
<h1 class="text-center">Categories</h1>
<div class="col-sm-6">
	{{Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store'])}}
	<input type="hidden" name="vocabulary_id" value="<?php echo $id; ?>">
		<div class="form-group">
			{{Form::label('name','Category:')}}
			{{Form::text('name',null,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			<div class="form-group">
			{!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}
			</div>
		</div>
	{{Form::close()}}
</div>
<div class="col-sm-6 pull-right">
@if($categories)
	<table class="table table-hover">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Name</th>
	        <th>Vocabulary</th>
	        <th>Created</th>
	        <th>Updated</th>
	        <th>Delete Category</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($categories as $category)
	    	<tr>
				<td>{{$category->id}}</td>
				<td><a href="{{route('categories.edit',$category->id)}}">{{$category->name}}</a></td>
				<td>{{$category->vocabulary->name}}</td>
				<td>{{$category->created_at ? $category->created_at->diffForHumans() : "No date"}}</td>
				<td>{{$category->updated_at ? $category->updated_at->diffForHumans() : "No date"}}</td>
				<td>
					{{Form::open(['method'=>'DELETE','action'=>['AdminCategoriesController@destroy',$category->id]])}}
						<div class="form-group">
						{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
						</div>
					{{Form::close()}}
				</td>
			</tr>
	    	@endforeach
	    </tbody>
	</table>
@else
	<h1 class="text-center">No Categories yet.</h1>
@endif
</div>
@stop