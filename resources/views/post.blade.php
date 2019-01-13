@extends('layouts.blog-post')

@section('content')
@if(Session::has('comment_message'))
	<p class="bg-success">{{session('comment_message')}}</p>
@else
    <p class="bg-success">{{session('comment_reply_created')}}</p>
@endif

@if($post)
	<h1>{{$post->title}}</h1>	

<!-- Author -->
<p class="lead">
    by <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<!-- <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->format('F d, Y \\a\\t h:i A')}} </p> -->
<p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}} </p>

<hr>

<!-- August 24, 2013 at 9:00 PM -->

<!-- Preview Image -->
<img class="img" height="500" width="700" src="{{$post->image_placeholder()}}" alt="">

<hr>

<!-- Post Content -->
<p class="lead">{!! $post->body !!}</p>

<hr>

<!-- Blog Comments -->

@else
    <h1 class="text-center">No Post Found</h1>
@endif

<!-- The traditional commenting system is in our includes folder in 'traditional_commenting_system.blade.php' file -->

@include('includes.disqus_comment')

@stop