@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($image) ? $image->name : 'Image')


@section('panel-content')
    
    {{ App\Sketchpad\FastForms::formDropzone('kml-dropzone', route('ajax.maps.dropzone.upload')) }}

    {{ 
        App\Sketchpad\FastForms::generate([
            'table' => 'images',
            'action' => $action == 'create' ? ['post', route('admin.images.store')] : ['put', route('admin.images.update', ['id' => $image->id])], 
            'errors' => $errors, 
            'values' => $image,
            'ignoreFields' => ['filename'],
            'customFields' => [
                '0' => '<div class="form-inline">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>KML Filename</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file fa-lg"></i></span>
                                        <input type="text" id="filename" name="filename" value="'. old('filename', (!empty($image->filename) ? $image->filename : '')) .'" readonly="true" class="form-control">
                                    </div>
                                    <a href="#" id="removeKml" class="btn btn-sm btn-danger">Remove</a>
                                </div>
                            </div>
                        </div><hr/>'
            ]
        ]) 
    }}

@endsection

@section('custom-footer-js')
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

    </script>
@endsection