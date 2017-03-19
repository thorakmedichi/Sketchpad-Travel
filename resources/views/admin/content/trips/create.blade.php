@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($trip) ? $trip->name : 'Trip')


@section('panel-content')

    {{ App\Sketchpad\FastForms::generate('trips', route('admin.trips.store'), $errors, $trip) }}

@endsection