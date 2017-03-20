@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Trips')

@section('panel-content')

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th>Map</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trips as $trip)
            <tr>
                <td><a href="{{ route('admin.trips.edit', ['id' => $trip->id]) }}"><h3>{{ $trip->name }}</h3></td>
                <td>
                    <div id="map-{{ $trip->id }}" class="map">
                        <div id="markerMenu" style="display: none;"></div>
                    </div>
                </td>
                <td>{{ $trip->start_date }}</td>
                <td>{{ $trip->end_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('custom-footer-js')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('apis.google_maps_api_key') }}&callback=initMap">
    </script>

    <script src="{{ url('js/google-maps/admin.js') }}"></script>

    <script>
        function initMap(){
            $(function(){
                initGoogleMapsObject();

                @foreach ($trips as $trip)
                    googleMaps.initMap('map-{{ $trip->id }}');

                    //googleMaps['map-{{ $trip->id }}'].setCenter({!! $trip->Map->center !!});
                    //googleMaps['map-{{ $trip->id }}'].setZoom({!! $trip->Map->zoom !!});
                    googleMaps['map-{{ $trip->id }}'].fitBounds({!! $trip->Map->bounds !!});
                @endforeach
            });
        }
    </script>
@endsection