@extends('layouts.admin')

@section('content')
	@if(count($comments) > 0)
		<h1>Comments</h1>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Id</th>
					<th>Photo</th>
					<th>Post</th>
					<th>Author</th>
					<th>Email</th>
					<th>Body</th>
					<th>Created</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach($comments as $comment)
					<tr>
						<td>{{$comment->id}}</td>
						<td><img height="80" width="100" src="{{$comment->photo}}" alt=""></td>
						<td><a href="{{route('home.post',$comment->post->id)}}">{{$comment->post->title}}</a></td>
						<td>{{$comment->author}}</td>
						<td>{{$comment->email}}</td>
						<td>{{str_limit($comment->body,30)}}</td>
						<td>{{$comment->created_at->diffForHumans()}}</td>
						<td>{{$comment->status()}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h1 class="text-center">Post has no comments</h1>
	@endif
@stop