@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($blog) ? $blog->title : 'Blog')


@section('panel-content')

    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'blogs',
            'action' => $action == 'create' ? ['post', route('admin.blogs.store')] : ['put', route('admin.blogs.update', ['id' => $blog->id])], 
            'errors' => $errors, 
            'values' => $blog 
        ]) 
    }}

@endsection