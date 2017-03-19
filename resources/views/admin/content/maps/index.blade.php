@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Maps')

@section('panel-content')

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th>KLM File</th>
                <th>Preview</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maps as $map)
            <tr>
                <td><a href="{{ route('admin.maps.edit', ['id' => $map->id]) }}">{{ $map->name }}</td>
                <td>{{ $map->klm_file }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection