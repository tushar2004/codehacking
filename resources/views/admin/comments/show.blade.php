@extends('layouts.admin')

@section('content')

@if(Session::has('unapproved'))
	<p class="bg-danger">{{session('unapproved')}}</p>
@elseif(Session::has('approved'))
	<p class="bg-success">{{session('approved')}}</p>
@else
	<p class="bg-danger">{{session('deleted_comment')}}</p>
@endif

@if(count($comments) > 0)
	<h1>Comments</h1>
	<table class="table table-hover">
		<thead>
			<th>Id</th>
			<th>Photo</th>
			<th>Post</th>
			<th>Author</th>
			<th>Email</th>
			<th>Body</th>
			<th>Status</th>
			<th>Change Status</th>
			<th>Replies</th>
			<th>Created</th>
			<th>Delete Comment</th>
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
					<td>{{$comment->status()}}</td>
					<!-- My way (Though I know it is an unsecure approach) -->
					<!-- <td>
						<a href="/admin/comments/approve/{{$comment->id}}">Approve</a>
					</td>
					<td>
						<a href="/admin/comments/unapprove/{{$comment->id}}">Unapprove</a>
					</td> -->
					<td>
						@if($comment->is_active == 1)
								{{Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]])}}
								<input type="hidden" name="is_active" value="0">
									<div class="form-group">
										{{Form::submit('Un-approve',['class'=>'btn btn-success'])}}
									</div>
								{{Form::close()}}
						@else
								{{Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]])}}
								<input type="hidden" name="is_active" value="1">
									<div class="form-group">
										{{Form::submit('Approve',['class'=>'btn btn-info'])}}
									</div>
								{{Form::close()}}
						@endif
					</td>
					<td><a href="{{route('replies.show',$comment->id)}}">View Replies</a></td>
					<td>{{$comment->created_at->diffForHumans()}}</td>
					<td>
							{{Form::open(['method'=>'DELETE','action'=>['PostCommentsController@destroy',$comment->id]])}}
								<div class="form-group">
									{{Form::submit('Delete',['class'=>'btn btn-danger'])}}
								</div>
							{{Form::close()}}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<h1 class="text-center">No Comments</h1>
@endif

@stop