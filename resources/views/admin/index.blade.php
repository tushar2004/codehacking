@if(!Auth::check())
	<script type="text/javascript">
		window.location = "{{ url('/') }}"; //here double curly brackets
	</script>
@endif

@extends('layouts.admin')
 
@section('content')
	<h1>Admin</h1>
@stop