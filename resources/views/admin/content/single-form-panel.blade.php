@extends('admin.wrapper')   

@section('content')
	<div class="row">
	    <div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	            <div class="panel-heading">
	            	<h3 class="panel-title pull-left">@yield('title')</h3>
	            	@if(empty($action))
		            	<a href="{{ $_SERVER['REQUEST_URI'] .'/create' }}" class="btn btn-primary btn-labeled fa fa-plus pull-right">Add</a>
		            @endif
	            </div>
	            <div class="panel-body">

	            	@yield ('panel-content')
	            
	            </div>
	        </div>
	    </div>
	</div>
@endsection