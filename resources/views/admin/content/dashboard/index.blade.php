@extends('admin.wrapper')   

{{-- Web site Title --}}
@section('title', 'Dashboard')

@section('content')
	<h1>Dashboard</h1>
	
    <div class="row">
    	<h3>Blogs</h3>
    	<ul>
    		@foreach ($blogs as $blog)
    		<li><a href="{{ route('admin.blogs.edit', ['id' => $blog->id]) }}">{{ $blog->title }}</a>
    		@endforeach
    	</ul>
    </div>

@endsection