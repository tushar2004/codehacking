<!-- Comments Form -->
@if(Auth::check())
<div class="well">
    <h4>Leave a Comment:</h4>
	{{Form::open(['method'=>'POST','action'=>'PostCommentsController@store'])}}
<!-- 		<div class="form-group">
			{{Form::label('author','Author:')}}
			{{Form::text('author',null,['class'=>'form-control'])}}
		</div> -->
		<input type="hidden" name="post_id" value="{{$post->id}}">
		<div class="form-group">
			{{Form::label('body','Body:')}}
			{{Form::textarea('body',null,['class'=>'form-control','rows'=>4])}}
		</div>
		<div class="form-group">
		{!! Form::submit('Comment',['class'=>'btn btn-primary']) !!}
		</div>
	{{Form::close()}}
</div>
@else
	<div class="alert alert-danger"><p>If you want to post a comment or reply to a comment, you need to be logged in.</p></div>
@endif

<hr>

<!-- Posted Comments -->

<!-- Comment -->

    @if(count($comments) > 0)
        @foreach($comments as $comment)
        <div class="media">
            <a class="pull-left" href="#">
                <img height="64" width="64" class="media-object" src="{{Auth::user()->gravatar}}}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$comment->author}}
                    <small>{{$comment->created_at->diffForHumans()}}</small>
                </h4>
                <p>{{$comment->body}}</p>
                
            @if(count($comment->replies) > 0)
                @foreach($comment->replies as $reply)
                <!-- Nested Comment -->
                @if($reply->is_active == 1)
                    <div id="nested-comment" class="media">
                        <a class="pull-left" href="#">
                            <img height="64" width="64" class="media-object img-rounded" src="{{$reply->photo}}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                {{$reply->author}}
                                <small>{{$reply->created_at->diffForHumans()}}</small>
                            </h4>
                            <p>{{$reply->body}}</p>
                        </div>
                        @if(Auth::check())
                            <div class="comment-reply-container">
                                <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                                    <div class="comment-reply col-sm-6">
                                        {{Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply'])}}
                                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                            <div class="form-group">
                                                {{Form::label('body','Body:')}}
                                                {{Form::textarea('body',null,['class'=>'form-control','rows'=>1])}}
                                            </div>
                                            <div class="form-group">
                                                {{Form::submit('Submit Reply',['class'=>'btn btn-primary'])}}
                                            </div>
                                        {{Form::close()}}
                                    </div>
                            </div>
                        @endif
                    </div>
                @endif
                <!-- End of nested comment -->
                @endforeach
            @else
                <h class="text-center">No replies</h>
            @endif

            @if(Auth::check())
                    <div class="comment-reply-container">
                    <button class="toggle-reply btn btn-primary pull-right">Reply</button>
                        <div class="comment-reply col-sm-6">
                            {{Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply'])}}
                                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                <div class="form-group">
                                    {{Form::label('body','Body:')}}
                                    {{Form::textarea('body',null,['class'=>'form-control','rows'=>1])}}
                                </div>
                                <div class="form-group">
                                    {{Form::submit('Submit Reply',['class'=>'btn btn-primary'])}}
                                </div>
                            {{Form::close()}}
                        </div>
                    </div>  
            @endif

            </div>
        </div>
        @endforeach
    @else
    <div class="alert alert-danger">
        <p>Post has no comments.</p>
    </div>

@section('scripts')
    <script type="text/javascript">
        $('.comment-reply-container .toggle-reply').click(function(){
            $(this).next().slideToggle("show");
        });
    </script>
@stop