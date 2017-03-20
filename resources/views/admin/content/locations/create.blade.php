@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($location) ? $location->name : 'Location')


@section('panel-content')

    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'locations',
            'action' => $action == 'create' ? ['post', route('admin.locations.store')] : ['put', route('admin.locations.update', ['id' => $location->id])], 
            'errors' => $errors, 
            'values' => $location 
        ]) 
    }}

@endsection