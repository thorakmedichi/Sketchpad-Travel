<div id="page-alerts">
	
@if (isset($errors) && count($errors->all()) > 0)
<div class="alert-wrap in">
	<div class="alert alert-danger" role="alert">
		<button class="close" type="button"><i class="fa fa-times-circle"></i></button>
		<div class="media">
			<div class="media-left">
				<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
					<i class="fa fa-exclamation fa-lg"></i>
				</span>
			</div>
			<div class="media-body">
				<h4 class="alert-title">Error</h4>
				<p class="alert-message">There was an error with your form submission. Please check below.</p>
			</div>
		</div>
	</div>
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert-wrap in">
	<div class="alert alert-success" role="alert">
		<button class="close" type="button"><i class="fa fa-times-circle"></i></button>
		<div class="media">
			<div class="media-left">
				<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
					<i class="fa fa-check fa-lg"></i>
				</span>
			</div>
			<div class="media-body">
				<h4 class="alert-title">Success</h4>
				<p class="alert-message">{!! $message !!}</p>
			</div>
		</div>
	</div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert-wrap in">
	<div class="alert alert-danger" role="alert">
		<button class="close" type="button"><i class="fa fa-times-circle"></i></button>
		<div class="media">
			<div class="media-left">
				<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
					<i class="fa fa-exclamation fa-lg"></i>
				</span>
			</div>
			<div class="media-body">
				<h4 class="alert-title">Error</h4>
				<p class="alert-message">{!! $message !!}</p>
			</div>
		</div>
	</div>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert-wrap in">
	<div class="alert alert-warning" role="alert">
		<button class="close" type="button"><i class="fa fa-times-circle"></i></button>
		<div class="media">
			<div class="media-left">
				<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
					<i class="fa fa-exclamation fa-lg"></i>
				</span>
			</div>
			<div class="media-body">
				<h4 class="alert-title">Warning</h4>
				<p class="alert-message">{!! $message !!}</p>
			</div>
		</div>
	</div>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert-wrap in">
	<div class="alert alert-info" role="alert">
		<button class="close" type="button"><i class="fa fa-times-circle"></i></button>
		<div class="media">
			<div class="media-left">
				<span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
					<i class="fa fa-info fa-lg"></i>
				</span>
			</div>
			<div class="media-body">
				<h4 class="alert-title">Info</h4>
				<p class="alert-message">{!! $message !!}</p>
			</div>
		</div>
	</div>
</div>
@endif

</div>