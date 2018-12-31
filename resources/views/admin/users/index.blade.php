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
	        <th>Created</th>
	        <th>Updated</th>
	      </tr>
	    </thead>
	    <tbody>
	     	@if($users)
	     		@foreach($users as $user)
	     			<tr>
	     				<td>{{$user->id}}</td>
	     				<td>
	     					@if($user->photo == "")
								{{"No profile image."}}	
	     					@else
	     						<img class="img-circle img-responsive" src="{{$user->photo_with_custom_path()}}" height="50" width="50" alt="">
	     					@endif
	     				</td>
	     				<td>{{$user->name}}</td>
	     				<td>{{$user->email}}</td>
	     				<td>{{$user->role_id == "" ? "User has no role." : $user->role->name}}</td>
	     				<td>{{$user->is_active == 1 ? "Active" : "Not active"}}</td>
	     				<td>{{$user->created_at->diffForHumans()}}</td>
	     				<td>{{$user->updated_at->diffForHumans()}}</td>
	     			</tr>
	     		@endforeach
	     	@endif
	    </tbody>
	</table>
@stop