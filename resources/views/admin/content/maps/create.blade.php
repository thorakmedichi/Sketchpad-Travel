@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($map) ? $map->name : 'Map')


@section('panel-content')
    
    <div id="map">
        <div id="markerMenu" style="display: none;"></div>
    </div>

    {{ App\Sketchpad\FastForms::generate('maps', route('admin.maps.store'), $errors, $map) }}

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
                // Declare our view settings
                // If left blank the defaults set in the googleMaps.initMap() will be used
                // var initOptions = {
                //         //center: {lat: homeData.lat, lng: homeData.lng},
                //         zoom: 10,
                //         mapTypeId: 'roadmap',
                //         scrollwheel: false,
                //         mapTypeControl: true,
                //         mapTypeControlOptions: {
                //             style: google.maps.MapTypeControlStyle.HORIZONTAL_MENU,
                //             position: google.maps.ControlPosition.LEFT_BOTTOM
                //         }
                //     };
                googleMaps.initMap('map');
            });
        }
    </script>

    
@endsection