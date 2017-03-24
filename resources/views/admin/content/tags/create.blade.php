@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($tag) ? $tag->name : 'Tag')


@section('panel-content')

    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'tags',
            'action' => $action == 'create' ? ['post', route('admin.tags.store')] : ['put', route('admin.tags.update', ['id' => $tag->id])], 
            'errors' => $errors, 
            'values' => $tag
        ]) 
    }}

@endsection