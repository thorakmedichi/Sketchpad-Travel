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
                <th></th>
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
                <td>
                    <form action="{{ route('admin.trips.destroy', ['id' => $trip->id]) }}" role="form" method="post">
                        {{ csrf_field() }}{{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger pull-right">Delete</button>
                    </form>
                </td>
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
                    @if (!empty($trip->Map))
                        googleMaps.initMap('map-{{ $trip->id }}');

                        googleMaps.zoomToBounds(googleMaps['map-{{ $trip->id }}'], {!! $trip->Map->bounds !!});
                        
                        @if (!empty($trip->Map->kml_filename))
                            googleMaps.displayKml(googleMaps['map-{{ $trip->id }}'], '{{ Storage::disk('s3')->url($trip->Map->kml_filename) }}');
                        @else
                            googleMaps.drawBounds(googleMaps['map-{{ $trip->id }}'], {!! $trip->Map->bounds !!});
                        @endif

                    @endif
                @endforeach
            });
        }
    </script>
@endsection