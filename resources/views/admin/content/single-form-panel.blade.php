@extends('admin.wrapper')   

@section('content')
	<div class="row">
	    <div class="col-md-10 col-md-offset-1">
	        <div class="panel panel-default">
	            <div class="panel-heading"><h3 class="panel-title">@yield('title')</h3></div>
	            <div class="panel-body">

	            	@yield ('panel-content')
	            
	            </div>
	        </div>
	    </div>
	</div>
@endsection