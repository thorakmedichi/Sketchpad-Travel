@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Author')


@section('panel-content')

    {{ App\Sketchpad\FastForms::generate('authors', route('admin.authors.store'), $errors, !empty($authors) ? $authors : null) }}

@endsection