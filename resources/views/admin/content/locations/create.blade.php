@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($location) ? $location->name : 'Location')


@section('panel-content')

    {{ App\Sketchpad\FastForms::generate('locations', route('admin.locations.store'), $errors, $location) }}

@endsection