@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($map) ? $map->name : 'Map')


@section('panel-content')
    
    <div class="description-text">
        <p>You do not need to upload a KML file. Simply panning around the map and setting your zoom level will define the basic bounding box.</p>
        <p>If you do add a KML file the map zoom and bounding area will be automatically set.</p>
        <small>Uploading a file will save your file on your S3 server but will not save this map itself. Remember to add a name and then "Create" the map</small>
    </div>

    {{ App\Sketchpad\FastForms::formDropzone('kml-dropzone', route('ajax.maps.dropzone.upload')) }}

    <?php 
        App\Sketchpad\FastForms::generate([
            'table' => 'maps',
            'action' => $action == 'create' ? ['post', route('admin.maps.store')] : ['put', route('admin.maps.update', ['id' => $map->id])], 
            'errors' => $errors, 
            'values' => $map, 
            'ignoreFields' => ['kml_filename'],
            'hiddenFields' => ['bounds', 'center', 'zoom'],
            'customFields' => [
                '0' => '<div class="form-inline">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>KML Filename</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file fa-lg"></i></span>
                                        <input type="text" id="kml_filename" name="kml_filename" value="'. old('kml_filename', (!empty($map->kml_filename) ? $map->kml_filename : '')) .'" readonly="true" class="form-control">
                                    </div>
                                    <a href="#" id="removeKml" class="btn btn-sm btn-danger">Remove</a>
                                </div>
                            </div>
                        </div><hr/>',
                '2' => '<div id="map">
                            <div id="markerMenu" style="display: none;"></div>
                        </div>',
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
        Dropzone.autoDiscover = false;

        $(function(){
            var kmlDropzone = new Dropzone('#kml-dropzone', {
                maxFiles: 1,
                maxFilesize: 8, // MB
                acceptedFiles: '.kml',
                paramName: 'kml_file',
                addRemoveLinks: true,
                dictDefaultMessage: '<h3>Click or drag files here to upload</h3><p>Please note that you can only upload one file. Also, if you have an existing file with this same name it will be deleted.</p>',
                headers: {
                    'X-CSRF-Token': Laravel.csrfToken
                },
                init: function(){
                    this.on('success', function(file, response){
                        displayKml(response.s3Name);
                    });

                    this.on('removedfile', function(file, response){
                        removeKml();
                    });

                    this.on('error', function(file, response, xhr){
                        console.log (response);
                        console.log (xhr);
                    });
                }
            });

            var removeKml = function removeKml(){
                var filenameField = document.getElementById('kml_filename');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('ajax.maps.dropzone.delete') }}',
                    data: {map_id: '{{ !empty($map->id) ? $map->id : null }}', filename: filenameField.value, _token: Laravel.csrfToken},
                    dataType: 'json'
                }).done(function(response){
                    filenameField.value = '';
                    kmlDropzone.removeAllFiles( true );
                });
            }

            document.getElementById('removeKml').onclick = function(){
                removeKml();
            }
        });

        function displayKml(name){
            document.getElementById('kml_filename').value = name;
            googleMaps.displayKml(googleMaps.map, Laravel.s3DiskUrl +'/'+ name);
        }

        function initMap(){
            $(function(){
                initGoogleMapsObject();
                googleMaps.initMap('map');

                @if(Route::currentRouteName() === 'admin.maps.edit')
                    googleMaps.map.setCenter({!! $map->center !!});
                    googleMaps.map.setZoom({!! $map->zoom !!});
                    
                    @if (!empty($map->kml_filename))
                        displayKml('{{ $map->kml_filename }}');
                    @endif
                @endif
            });
        }
    </script>
@endsection