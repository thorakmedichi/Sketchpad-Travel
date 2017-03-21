@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($location) ? $location->name : 'Location')


@section('panel-content')
    
    <div id="map">
        <div id="markerMenu" style="display: none;"></div>
    </div>

    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'locations',
            'action' => $action == 'create' ? ['post', route('admin.locations.store')] : ['put', route('admin.locations.update', ['id' => $location->id])], 
            'errors' => $errors, 
            'values' => $location 
        ]) 
    }}

@endsection

@section('custom-footer-js')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('apis.google_maps_api_key') }}&libraries=places&callback=initMap">
    </script>

    <script src="{{ url('js/google-maps/admin.js') }}"></script>

    <script>
        function initMap(){
            $(function(){
                initGoogleMapsObject();
                googleMaps.initMap('map');

                @if(Route::currentRouteName() === 'admin.locations.edit')
                    var location = {"lat": {!! $location->lat !!}, "lng": {!! $location->lng !!}};
                    googleMaps.map.setCenter(location);
                    googleMaps.map.setZoom(6);

                    googleMaps.placeMarker(googleMaps.map, location, googleMaps.genericMarkerIcon);
                    googleMaps.autoCompleteSearch(googleMaps.map, 'map', function(){
                        var marker = googleMaps.autoCompleteAddMarker(this, googleMaps.map);
                        var place = this.getPlace();
                        var country = googleMaps.getAddressComponent(place, 'country');

                        // create and select option
                        var option = document.createElement("option");
                        option.text = country.long_name;
                        option.value = country.long_name;
                        option.setAttribute('selected', 'selected');
                        var select = document.getElementById("country_id");
                        select.appendChild(option);

                        // Set name
                        var name = document.getElementById('name');
                        if (name) name.value = place.name;

                        // Set Google Place Id
                        var name = document.getElementById('google_place_id');
                        if (name) name.value = place.place_id;

                        // Set lat
                        var lat = document.getElementById('lat');
                        if (lat) lat.value = place.geometry.location.lat();

                        // Set lng
                        var lng = document.getElementById('lng');
                        if (lng) lng.value = place.geometry.location.lng();
                    });
                    
                @endif
            });
        }
    </script>
@endsection