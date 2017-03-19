@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($map) ? $map->name : 'Map')


@section('panel-content')

    {{ App\Sketchpad\FastForms::generate('maps', route('admin.maps.store'), $errors, $map) }}

@endsection