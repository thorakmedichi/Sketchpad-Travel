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
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
            <tr>
                <td><a href="{{ route('admin.authors.edit', ['id' => $author->id]) }}">{{ $author->User->name }}</a></td>
                <td>{{ $author->email }}</td>
                <td>{{ $author->age }}</td>
                <td>
                    <form action="{{ route('admin.authors.destroy', ['id' => $author->id]) }}" role="form" method="post">
                        {{ csrf_field() }}{{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger pull-right">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection