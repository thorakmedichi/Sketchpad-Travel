@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($map) ? $map->name : 'Map')


@section('panel-content')
    
    <div id="map">
        <div id="markerMenu" style="display: none;"></div>
    </div>

    <?php 
        App\Sketchpad\FastForms::generate([
            'table' => 'maps',
            'action' => $action == 'create' ? ['post', route('admin.maps.store')] : ['put', route('admin.maps.update', ['id' => $map->id])], 
            'errors' => $errors, 
            'values' => $map, 
            'ignoreFields' => ['klm_file'],
            'customFields' => [App\Sketchpad\FastForms::formFile('klm_file', 'KLM File', $errors)],
            ]);
    ?>

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
                googleMaps.initMap('map');

                @if(Route::currentRouteName() === 'admin.maps.edit')
                    googleMaps.map.setCenter({!! $map->center !!});
                    googleMaps.map.setZoom({!! $map->zoom !!});
                    //googleMaps.map.fitBounds({!! $map->bounds !!});
                @endif
            });
        }
    </script>
@endsection