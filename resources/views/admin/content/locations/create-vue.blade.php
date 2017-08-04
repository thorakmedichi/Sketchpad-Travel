@extends('admin.wrapper')

{{-- Web site Title --}}
@section('title', !empty($location) ? $location->name : 'Location')


@section('content')
    
    <div id="location"></div>



    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'locations',
            'action' => $action == 'create' ? ['post', route('admin.locations.store')] : ['put', route('admin.locations.update', ['id' => $location->id])], 
            'errors' => $errors, 
            'values' => $location, 
            'hiddenFields' => ['google_place_id', 'lat', 'lng']
        ]) 
    }}

@endsection

@section('custom-footer-js')
    <script src="{{ url('js/location.js') }}"></script>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('apis.google_maps_api_key') }}&libraries=places&callback=initMap">
    </script>

    <script src="{{ url('js/google-maps/admin.js') }}"></script>

    <script>
        function updateLatLngInputs(lat, lng){
            // Set lat
            var latEl = document.getElementById('lat');
            if (latEl) latEl.value = lat;

            // Set lng
            var lngEl = document.getElementById('lng');
            if (lngEl) lngEl.value = lng;
        }

        function initMap(){
            $(function(){
                initGoogleMapsObject();
                googleMaps.initMap('map');

                @if(Route::currentRouteName() === 'admin.locations.edit')
                    var location = {"lat": {!! $location->lat !!}, "lng": {!! $location->lng !!}};
                    googleMaps.zoomToCoordinates(googleMaps.map, location);

                    googleMaps.placeMoveableMarker(googleMaps.map, location, null, function(){
                        updateLatLngInputs(this.position.lat(), this.position.lng());
                    });
                @endif

                googleMaps.autoCompleteSearch(googleMaps.map, 'map', function(){
                    var place = this.getPlace();
                    var country = googleMaps.getAddressComponent(place, 'country');

                    googleMaps.clearMarkers();
                    googleMaps.zoomToCoordinates(googleMaps.map, googleMaps.getCoordinatesFromPlace(place));

                    googleMaps.placeMoveableMarker(googleMaps.map, googleMaps.getCoordinatesFromPlace(place), null, function(){
                        updateLatLngInputs(this.position.lat(), this.position.lng());
                    });

                    // create and select option
                    var select = document.getElementById("country_id");
                    if (select) select.value = country.short_name;

                    // Set name
                    var name = document.getElementById('name');
                    if (name) name.value = place.name;

                    // Set Google Place Id
                    var name = document.getElementById('google_place_id');
                    if (name) name.value = place.place_id;

                    updateLatLngInputs(place.geometry.location.lat(), place.geometry.location.lng());
                });
            });
        }
    </script>
@endsection