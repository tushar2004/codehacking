@extends('layouts.admin')

@section('content')

<div class="col-sm-6">
    <h1 class="text-center">Create Gallery</h1>
    {{Form::open(['method'=>'POST','action'=>'AdminGalleryController@store'])}}
        <div class="form-group">
            {{Form::label('name','Name:')}}
            {{Form::text('name',null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
            {{Form::label('category_id','Category')}}
            {{Form::select('category_id',[''=>'Choose Category'] + $categories,null,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
        {!! Form::submit('Create Gallery',['class'=>'btn btn-primary']) !!}
        </div>
    {{Form::close()}}
</div>

<div class="col-sm-6">
    @if(count($galleries) > 0)
    <h1 class="text-center">Galleries</h1>
<table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Category</th>
        <th>No. of photos</th>
        <th>Delete Gallery</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($galleries as $gallery)
			<tr>
				<td>{{$gallery->id}}</td>
				<td><a href="{{route('gallery.uploadpage',$gallery->id)}}">{{$gallery->name}}</a></td>
                <td>{{$gallery->category->name}}</td>
				<td>{{$gallery->photos()->count()}}</td>
                <td>
                    {{Form::open(['method'=>'DELETE','action'=>['AdminGalleryController@destroy',$gallery->id]])}}
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
	<h1 class="text-center">No Gallery yet.</h1>
@endif
</div>

@stop