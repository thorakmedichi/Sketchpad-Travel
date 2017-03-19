@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Trips')

@section('panel-content')

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trips as $trip)
            <tr>
                <td><a href="{{ route('admin.trips.edit', ['id' => $trip->id]) }}">{{ $trip->name }}</td>
                <td>{{ $trip->start_date }}</td>
                <td>{{ $trip->end_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection