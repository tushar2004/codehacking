@extends('layouts.admin');

@section('content')
<h1 class="text-center">Vocabularies</h1>
<div class="col-sm-6">
	{{Form::open(['method'=>'POST','action'=>'AdminVocabulariesController@store'])}}
		<div class="form-group">
			{{Form::label('name','Vocabulary:')}}
			{{Form::text('name',null,['class'=>'form-control'])}}
		</div>
		<div class="form-group">
			<div class="form-group">
			{!! Form::submit('Create vocabulary',['class'=>'btn btn-primary']) !!}
			</div>
		</div>
	{{Form::close()}}
</div>
<div class="col-sm-6 pull-right">
@if(count($vocabularies) > 0)
	<table class="table table-hover">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Name</th>
	        <th>Created</th>
	        <th>Updated</th>
	        <th>Delete Vocabulary</th>
	        <th>Edit Vocabulary</th>
	      </tr>
	    </thead>
	    <tbody>
	    	@foreach($vocabularies as $vocabulary)
	    	<tr>
				<td>{{$vocabulary->id}}</td>
				<td><a href="{{route('taxonomy.show',$vocabulary->id)}}" target="_blank">{{$vocabulary->name}}</a></td>
				<td>{{$vocabulary->created_at ? $vocabulary->created_at->diffForHumans() : "No date"}}</td>
				<td>{{$vocabulary->updated_at ? $vocabulary->updated_at->diffForHumans() : "No date"}}</td>
				<td>
					{{Form::open(['method'=>'DELETE','action'=>['AdminVocabulariesController@destroy',$vocabulary->id]])}}
						<div class="form-group">
						{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
						</div>
					{{Form::close()}}
				</td>
				<td><a href="{{route('taxonomy.edit',$vocabulary->id)}}" class="btn btn-info">Edit Vocabulary</a></td>
			</tr>
	    	@endforeach
	    </tbody>
	</table>
@else
	<h3 class="text-center">No Vocabularies yet.</h3>
@endif
</div>
@stop