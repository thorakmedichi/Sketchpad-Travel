@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Locations')

@section('panel-content')

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th>Created</th>
                <th>Visited</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
            <tr>
                <td><a href="{{ route('admin.locations.edit', ['id' => $location->id]) }}">{{ $location->name }}</td>
                <td>{{ $location->Country->long_name }}</td>
                <td>{{ $location->created_at }}</td>
                <td>{{ $location->visit_date }}</td>
                <td>
                    <form action="{{ route('admin.locations.destroy', ['id' => $location->id]) }}" role="form" method="post">
                        {{ csrf_field() }}{{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger pull-right">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection