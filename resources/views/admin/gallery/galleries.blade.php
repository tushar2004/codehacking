@extends('layouts.admin')

@section('content')
	
	@if(count($galleries) > 0)
		<h1 class="text-center">Galleries</h1>
		@foreach($galleries as $gallery)
		<p>
			@if(count($gallery->photos) > 0)
				<div class="col-sm-3">
					<h3><code><a style="text-decoration:none; color:inherit" href="{{route('gallery.show',$gallery->id)}}">{{$gallery->category->name}}</a></code></h5>
					<a href="{{route('gallery.show',$gallery->id)}}"><img src="{{$gallery->photos()->first()->path}}" class="img img-rounded" height="150" width="200" alt=""></a>
				</div>
			@endif
		</p>
		@endforeach
	@else
		<h1 class="text-center">No Gallery yet.</h1>
	@endif
@stop