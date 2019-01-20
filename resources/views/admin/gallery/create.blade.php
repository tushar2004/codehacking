@extends('layouts.admin')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">

@stop

@section('content')
<h1 class="text-center">Create Gallery</h1>

	{{Form::open(['method'=>'POST','action'=>'AdminGalleryController@store','files'=>true,'class'=>'dropzone'])}}
	{{Form::close()}}
<br>
@stop

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

@stop

