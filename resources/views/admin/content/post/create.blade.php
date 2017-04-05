@extends('admin.wrapper')

{{-- Web site Title --}}
@section('title', 'Post')


@section('panel-content')

    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'authors',
            'action' => $action == 'create' ? ['post', route('admin.authors.store')] : ['put', route('admin.authors.update', ['id' => $blog->id])], 
            'errors' => $errors, 
            'values' => $author 
        ]) 
    }}

@endsection