@extends('layouts.admin')

@section('content')

	<h1 class="text-center">Posts</h1>

	<table class="table table-hover">
		<thead>
			<tr>
				<th>Id</th>
				<th>Photo</th>
				<th>Title</th>
				<th>User</th>
				<th>Category</th>
				<th>View Post</th>
				<th>Created</th>
				<th>Updated</th>
				<th>Comments</th>
				<th>Delete Post</th>
			</tr>
		</thead>
		<tbody>
			@if($posts)
				@foreach($posts as $post)
					<tr>
						<td>{{$post->id}}</td>
						<td><img height="80" width="100" class="img-rounded" src="{{$post->image_placeholder()}}" alt=""></td>
						<td><a href="{{route('posts.edit',$post->slug)}}">{{$post->title}}</a></td>
						<td>{{$post->user->name}}</td>
						<td>{{$post->category ? $post->category->name : "Uncategorized"}}</td>
						<td><a href="{{route('home.post',$post->slug)}}">View</a></td>
						<td>{{$post->created_at->diffForHumans()}}</td>
						<td>{{$post->updated_at->diffForHumans()}}</td>
						<td>
							<a href="{{route('comments.show',$post->id)}}">View Comments</a>
						</td>
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
	<div class="row">
		<div class="col-sm-6 col-sm-offset-5">
			<!-- The method edwin used in the course to display the pagination:- {{$posts->render()}} -->
			{{$posts->links()}}
		</div>
	</div>
@stop