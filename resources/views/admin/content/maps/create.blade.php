@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($map) ? $map->name : 'Map')


@section('panel-content')
    


    <div id="map">
        <div id="markerMenu" style="display: none;"></div>
    </div>

    {{ App\Sketchpad\FastForms::formDropzone(route('api.maps.dropzone')) }}

    <?php 
        App\Sketchpad\FastForms::generate([
            'table' => 'maps',
            'action' => $action == 'create' ? ['post', route('admin.maps.store')] : ['put', route('admin.maps.update', ['id' => $map->id])], 
            'errors' => $errors, 
            'values' => $map, 
            'ignoreFields' => ['kml_filename'],
            'customFields' => [
                '<div class="form-group">
                    <div class="col-md-12">
                        <label>KML Filename</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file fa-lg"></i></span>
                            <input type="text" id="kml_filename" name="kml_filename" value="'. (!empty($map->kml_filename) ? $map->kml_filename : '') .'" readonly="true" class="form-control">
                        </div>
                    </div>
                </div>',
                App\Sketchpad\FastForms::formFile('kml_file', 'KML File', $errors)
            ],
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
                    
                    @if (!empty($map->kml_filename))
                    var kmlOverlay = new google.maps.KmlLayer({
                        url: '{{ Storage::disk('s3')->url($map->kml_filename) }}',
                        map: googleMaps.map
                    });
                    @endif
                @endif

                //var myDropzone = new Dropzone('#kml_files', { url: '/file/post', paramName: 'kml_file'});
            });
        }
    </script>
@endsection