@extends('layouts.blog-home')

@section('content')

<div class="row">
	<div class="col-md-8">
		
		<!-- custom made commenting system flash messages -->
		@include('includes.flash_messages')

		@if($post)
			<h1>{{$post->title}}</h1>	

		<!-- Author -->
		<p class="lead">
		    by <code>{{$post->user->name}}</code>
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
	</div>

	@include('front.home_sidebar_nav')

	<!-- The custom made commenting system is in the includes folder in 'traditional_commenting_system.blade.php' file -->
	<div class="col-sm-6">
		@include('includes.disqus_comment')
	</div>

</div>
@stop