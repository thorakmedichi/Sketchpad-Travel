@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Blog')


@section('panel-content')

    {{ App\Sketchpad\FastForms::generate('blogs', route('admin.blogs.store'), $errors, !empty($blog) ? $blog : null, ['3', function() use ($blog, $errors){
    	App\Sketchpad\FastForms::formSelect('Relation', 'blog_relation', 'pencil', App\BlogRelation::getSelectOptions(), $errors, $blog->Relation()->type);
    	}]) }}

@endsection