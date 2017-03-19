@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($image) ? $image->name : 'Image')


@section('panel-content')

    {{ App\Sketchpad\FastForms::generate('images', route('admin.images.store'), $errors, $image) }}

@endsection