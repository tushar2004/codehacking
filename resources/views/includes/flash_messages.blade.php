<!-- custom made commenting system flash messages -->
@if(Session::has('comment_message'))
	<div class="alert alert-success">
		<p><span class="glyphicon glyphicon-ok"> {{session('comment_message')}}</span></p>
	</div>
@elseif(Session::has('comment_reply_created'))
	<div class="alert alert-success">
		<p><span class="glyphicon glyphicon-ok"> {{session('comment_reply_created')}}</span></p>
	</div>
@endif

<!-- admin categories area -->

@if(Session::has('deleted_category'))
	<div class="alert alert-danger">
		<p><span class="glyphicon glyphicon-ok"> {{session('deleted_category')}}</span></p>
	</div>
@elseif(Session::has('updated_category'))
	<div class="alert alert-success">
		<p><span class="glyphicon glyphicon-ok"> {{session('updated_category')}}</span></p>
	</div>
@elseif(Session::has('created_category'))
	<div class="alert alert-info">
		<p><span class="glyphicon glyphicon-ok"> {{session('created_category')}}</span></p>
	</div>
@endif

<!-- admin comments area -->

@if(Session::has('unapproved'))
	<div class="alert alert-danger">
		<p><span class="glyphicon glyphicon-ok"> {{session('unapproved')}}</span></p>
	</div>
@elseif(Session::has('approved'))
	<div class="alert alert-success">
		<p><span class="glyphicon glyphicon-ok"> {{session('approved')}}</span></p>
	</div>
@elseif(Session::has('deleted_comment'))
	<div class="alert alert-danger">
		<p><span class="glyphicon glyphicon-ok"> {{session('deleted_comment')}}</span></p>
	</div>
@endif

<!-- admin comment replies area -->

@if(Session::has('Approved'))
	<div class="alert alert-success">
		<p><span class="glyphicon glyphicon-ok"></span> {{session('Approved')}}</p>
	</div>
@elseif(Session::has('Unapproved'))
	<div class="alert alert-danger">
		<p><span class="glyphicon glyphicon-ok"></span> {{session('Unapproved')}}</p>	
	</div>
@elseif(Session::has('deleted_reply'))
	<div class="alert alert-danger">
		<p><span class="glyphicon glyphicon-ok"></span> {{session('deleted_reply')}}</p>
	</div>
@endif

<!-- admin media area -->

@if(Session::has('deleted_media'))
	<div class="alert alert-danger">	
		<p><span class="glyphicon glyphicon-ok"></span> {{session('deleted_media')}}</p>
	</div>
@elseif(Session::has('uploaded_media'))
	<div class="alert alert-info">
		<p><span class="glyphicon glyphicon-ok"></span> {{session('uploaded_media')}}</p>
	</div>
@endif

<!-- admin posts area -->

@if(Session::has('deleted_post'))
	<div class="alert alert-danger">
		<p><span class="glyphicon glyphicon-ok"></span> {{session('deleted_post')}}</p>
	</div>
@elseif(Session::has('created_post'))
	<div class="alert alert-success">
		<p><span class="glyphicon glyphicon-ok"></span> {{session('created_post')}}</p>
	</div>
@endif

<!-- admin users area -->
@if(Session::has('deleted_user'))
	<div class="alert alert-danger">
		<p><span class="glyphicon glyphicon-ok"></span> {{session('deleted_user')}}</p>
	</div>
@elseif(Session::has('updated_user'))
	<div class="alert alert-success">
		<p><span class="glyphicon glyphicon-ok"></span> {{session('updated_user')}}</p>
	</div>
@elseif(Session::has('created_user'))
	<div class="alert alert-info">
		<p><span class="glyphicon glyphicon-ok"></span> {{session('created_user')}}</p>
	</div>
@endif