@extends('layouts.admin')

@section('content')

	@if(Session::has('deleted_post'))
		<p class="bg-danger">{{session('deleted_post')}}</p>
	@endif

	<h1 class="text-center">Posts</h1>

	<table class="table table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Photo</th>
				<th>User</th>
				<th>Category</th>
				<th>Title</th>
				<th>Body</th>
				<th>Created</th>
				<th>Updated</th>
				<th>Delete Post</th>
			</tr>
		</thead>
		<tbody>
			@if($posts)
				@foreach($posts as $post)
					<tr>
						<td>{{$post->id}}</td>
						<td><img height="80" width="100" class="img-rounded" src="{{$post->image_placeholder()}}" alt=""></td>
						<td><a href="{{route('posts.edit',$post->id)}}">{{$post->user->name}}</a></td>
						<td>{{$post->category ? $post->category->name : "Uncategorized"}}</td>
						<td>{{$post->title}}</td>
						<td>{{str_limit($post->body,30)}}</td>
						<td>{{$post->created_at->diffForHumans()}}</td>
						<td>{{$post->updated_at->diffForHumans()}}</td>
						<td>
							{{Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]])}}
								<div class="form-group">
								{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
								</div>
							{{Form::close()}}
						</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
@stop