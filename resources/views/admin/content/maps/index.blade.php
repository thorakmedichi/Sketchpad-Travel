@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Maps')

@section('panel-content')
    
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th>Preview</th>
                <th>KML File</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maps as $map)
            <tr>
                <td><a href="{{ route('admin.maps.edit', ['id' => $map->id]) }}"><h3>{{ $map->name }}</h3></td>
                <td>
                    <div id="map-{{ $map->id }}" class="map">
                        <div id="markerMenu" style="display: none;"></div>
                    </div>
                </td>
                <td>{{ $map->kml_filename }}</td>
                <td>
                    <form action="{{ route('admin.maps.destroy', ['id' => $map->id]) }}" role="form" method="post">
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

                @foreach ($maps as $map)
                    googleMaps.initMap('map-{{ $map->id }}');

                    googleMaps.zoomToBounds(googleMaps['map-{{ $map->id }}'], {!! $map->bounds !!});

                    @if (!empty($map->kml_filename))
                        googleMaps.displayKml(googleMaps['map-{{ $map->id }}'], '{{ Storage::disk('s3')->url($map->kml_filename) }}');
                    @else
                        googleMaps.drawBounds(googleMaps['map-{{ $map->id }}'], {!! $map->bounds !!});
                    @endif
                @endforeach
            });
        }
    </script>
@endsection