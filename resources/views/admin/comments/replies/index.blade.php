@extends('layouts.admin')

@section('content')

	@if(count($replies) > 0)
		<h1 class="text-center">Comment Replies</h1>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Id</th>
					<th>Photo</th>
					<th>Post</th>
					<th>Author</th>
					<th>Email</th>
					<th>Body</th>
					<th>Status</th>
					<th>Change Status</th>
					<th>Created</th>
					<th>Delete Reply</th>
				</tr>
			</thead>
			<tbody>
				@foreach($replies as $reply)
					<tr>
						<td>{{$reply->id}}</td>
						<td><img height="80" class="img-rounded" width="100" src="{{$reply->photo}}" alt=""></td>
						<td><a href="{{route('home.post',$reply->comment->post->id)}}">{{$reply->comment->post->title}}</a></td>
						<td>{{$reply->author}}</td>
						<td>{{$reply->email}}</td>
						<td>{{str_limit($reply->body,30)}}</td>
						<td>{{$reply->status()}}</td>
						<td>
							@if($reply->is_active == 0)
									{{Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]])}}
										<input type="hidden" name="is_active" value="1">
										<div class="form-group">
											{{Form::submit('Approve',['class'=>'btn btn-info'])}}
										</div>
									{{Form::close()}}
							@else
									{{Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]])}}
										<div class="form-group">
											<input type="hidden" name="is_active" value="0">
											{{Form::submit('Un-approve',['class'=>'btn btn-success'])}}
										</div>
									{{Form::close()}}
							@endif
						</td>
						<td>{{$reply->created_at->diffForHumans()}}</td>
						<td>
								{{Form::open(['method'=>'DELETE','action'=>['CommentRepliesController@destroy',$reply->id]])}}
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
		<h1 class="text-center">No replies yet.</h1>
	@endif

@stop