@extends('layouts.admin')

@section('styles')
	<link rel="stylesheet" href="/css/nanogallery/nanogallery2.min.css">
@stop


@section('content')
	@if($photos)
		<h1 class="text-center">Photos</h1>
		<div id="nanogallery"></div>
		{{$src=''}}
		@foreach($photos as $photo)
			<?php $src .= "{ src: '{$photo->path}', title: 'Test' },"; ?>
		@endforeach
	@else
		<h1 class="text-center">No photos in this gallery.</h1>
	@endif
@stop

@section('scripts')
	<script src="{{asset('js/nanogallery/jquery.nanogallery2.min.js')}}"></script>
	<script>
		$("#nanogallery").nanogallery2({
  <!-- ### gallery settings ### -->
  		thumbnailHeight:  150,
  		thumbnailWidth:   'auto',
  		itemsBaseURL:     '',

  <!-- ### gallery content ### -->
  items: [
  <?php echo $src; ?>
  	  // { src: 'berlin1.jpg', srct: 'berlin1t.jpg', title: 'Title Image 1' },
     //  { src: 'berlin2.jpg', srct: 'berlin2t.jpg', title: 'Title Image 2' },
     //  { src: 'berlin3.jpg', srct: 'berlin3t.jpg', title: 'Title Image 3' }
  ]
});
	</script>
@stop

