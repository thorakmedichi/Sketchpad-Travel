@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Authors')

@section('panel-content')

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
                <td><a href="{{ route('admin.authors.edit', ['id' => $author->id]) }}">{{ $author->User->name }}</a></td>
                <td>{{ $author->email }}</td>
                <td>{{ $author->age }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection