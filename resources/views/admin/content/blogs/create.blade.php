@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($blog) ? $blog->title : 'Blog')


@section('panel-content')

    {{ App\Sketchpad\FastForms::generate('blogs', route('admin.blogs.store'), $errors, $blog, ['3', function() use ($blog, $errors){
    	App\Sketchpad\FastForms::formSelect('Relation', 'blog_relation', 'pencil', App\BlogRelation::getSelectOptions(), $errors, !empty($blog) ? $blog->Relation()->type : null);
    	}]) }}

@endsection