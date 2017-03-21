@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($image) ? $image->name : 'Image')


@section('panel-content')

    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'images',
            'action' => $action == 'create' ? ['post', route('admin.images.store')] : ['put', route('admin.images.update', ['id' => $image->id])], 
            'errors' => $errors, 
            'values' => $image 
        ]) 
    }}

@endsection