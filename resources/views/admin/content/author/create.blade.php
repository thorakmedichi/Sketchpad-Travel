@extends('admin.wrapper')

{{-- Web site Title --}}
@section('title', 'Dashboard')


@section('content')
<div id="page-content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Author</h3></div>
                <div class="panel-body">
                    {{ App\Sketchpad\FastForms::generate('authors', route('admin.author.store'), $errors) }}
                </div>
            </div>
        </div>
    </div>
@endsection