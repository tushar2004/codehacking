@extends('layouts.admin')

@section('content')
	
	@if(count($galleries) > 0)
		<h1 class="text-center">Galleries</h1>
		@foreach($galleries as $gallery)
		<p>
			@if(count($gallery->photos) > 0)
				<div class="col-sm-3">
					<h3>{{$gallery->category->name}}</h5>
					<a href="{{route('gallery.show',$gallery->id)}}"><img src="{{$gallery->photos()->first()->path}}" class="img img-thumbnail" height="200" width="200" alt=""></a>
				</div>
			@endif
		</p>
		@endforeach
	@else
		<h1 class="text-center">No Gallery yet.</h1>
	@endif
@stop