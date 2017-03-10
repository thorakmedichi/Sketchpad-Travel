@extends('layouts.wrapper')

{{-- Web site Title --}}
@section('title', 'Dashboard')


@section('content')
<div id="page-content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Introduction</h3></div>
                <div class="panel-body">
                    <p>Welcome to {{ Config::get('brand.site_brand') }}.</p>
                </div>
            </div>
        </div>
    </div>
@endsection