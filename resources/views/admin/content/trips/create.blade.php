@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($trip) ? $trip->name : 'Trip')


@section('panel-content')

    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'trips',
            'action' => $action == 'create' ? ['post', route('admin.trips.store')] : ['put', route('admin.trips.update', ['id' => $trip->id])], 
            'errors' => $errors, 
            'values' => $trip 
        ]) 
    }}

@endsection