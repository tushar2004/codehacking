@extends('layouts.admin')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">

@stop

@section('content')
<h1 class="text-center">Upload photos to <code>{{$gallery->name}}</code></h1>

	{{Form::open(['method'=>'POST','action'=>'AdminGalleryController@upload','files'=>true,'class'=>'dropzone'])}}
	<input type="hidden" name="gallery_id" value="<?php echo $gallery->id; ?>">
	{{Form::close()}}
<br>
@stop

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

@stop

