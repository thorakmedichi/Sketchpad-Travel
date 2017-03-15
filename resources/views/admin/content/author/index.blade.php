@extends('admin.wrapper')

{{-- Web site Title --}}
@section('title', 'Dashboard')


@section('content')
<div id="page-content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Introduction</h3></div>
                <div class="panel-body">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Age</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                            <tr>
                                <td><a href="{{ route('admin.author.edit', ['id' => $author->id]) }}">{{ $author->User->name }}</a></td>
                                <td>{{ $author->email }}</td>
                                <td>{{ $author->age }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection