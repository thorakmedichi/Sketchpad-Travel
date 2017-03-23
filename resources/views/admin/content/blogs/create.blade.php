@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($blog) ? $blog->title : 'Blog')


@section('panel-content')

    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'blogs',
            'action' => $action == 'create' ? ['post', route('admin.blogs.store')] : ['put', route('admin.blogs.update', ['id' => $blog->id])], 
            'errors' => $errors, 
            'values' => $blog, 
            'customFields' => [
                '2' => App\Sketchpad\FastForms::formSelect('locations[]', 'Locations', 'map-marker', App\Location::getSelectOptions(), $errors, $action == 'edit' ?array_pluck($blog->Locations->toArray(), 'id') : [], true),
                '3' => App\Sketchpad\FastForms::formSelect('trips[]', 'Trips', 'map', App\Trip::getSelectOptions(), $errors, $action == 'edit' ?array_pluck($blog->Trips->toArray(), 'id') : [], true)
            ]
        ]) 
    }}

@endsection