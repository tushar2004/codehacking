@extends('layouts.admin')

@section('content')

@if(count($photos) > 0)
<h1>Photos</h1>

<form action="delete/media" method="post" class="form-inline">
	{{csrf_field()}}
	{{method_field('delete')}}
	<div class="form-group">
		<select name="checkBoxArray" class="form-control" id="">
			<option value="delete">Delete</option>
		</select>
		<div class="form-group">
			<input type="submit" name="delete_bulk" class="btn btn-primary" value="Apply">
		</div>
	</div> 
	<table class="table table-hover">
		<thead>
			<tr>
				<td><input type="checkbox" id="checkBoxes"></td>
				<th>Id</th>
				<th>Photo</th>
				<th>Created</th>
				<th>Updated</th>
			</tr>
		</thead>
		<tbody>
				@foreach($photos as $photo)
					<tr>
						<td><input class="checkboxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}" id=""></td>
						<td>{{$photo->id}}</td>
						<td><img height="80" width="100" class="img-rounded" src="{{$photo->image_placeholder()}}" alt=""></td>
						<td>{{($photo->created_at) ? $photo->created_at : 'No date'}}</td>
						<td>{{($photo->updated_at) ? $photo->updated_at : 'No date'}}</td>
					</tr>
				@endforeach
		</tbody>
	</table>

</form>
@else
	<h1 class="text-center">No photos uploaded yet.</h1>
@endif
	@section('scripts')
		<script>
			$(document).ready(function(){
				$('#checkBoxes').click(function(){
					if(this.checked){
						$('.checkboxes').each(function(){
							this.checked = true;
						});
						// console.log('the checkbox is checked');
					}else{
						$('.checkboxes').each(function(){
							this.checked = false;
						});
					}
				});
			});
		</script>
	@stop

@stop