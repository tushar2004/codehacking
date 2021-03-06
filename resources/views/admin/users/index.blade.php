@extends('layouts.admin')

@section('content')

	<h1>Users</h1>
	<table class="table table-hover">
	    <thead>
	      <tr>
	      	<th>Id</th>
	      	<th>Profile Image</th>
	        <th>Name</th>
	        <th>Email</th>
	        <th>Role</th>
	        <th>Status</th>
	      </tr>
	    </thead>
	    <tbody>
	     	@if($users)
	     		@foreach($users as $user)
	     			<tr>
	     				<td>{{$user->id}}</td>
	     				<td><img class="img-rounded" height="80" width="100" src="{{$user->image_placeholder()}}" alt=""></td>
	     				<td><a href="{{route('users.edit',$user->id)}}">{{$user->name}}</a></td>
	     				<td>{{$user->email}}</td>
	     				<td>{{$user->role ? $user->role->name : "User has no role"}}</td>
	     				<td>{{$user->is_active == 1 ? "Active" : "Not active"}}</td>
	     				
	     			</tr>
	     		@endforeach
	     	@endif
	    </tbody>
	</table>
@stop