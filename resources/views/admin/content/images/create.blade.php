@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', !empty($image) ? $image->name : 'Image')


@section('panel-content')
    
    {{ App\Sketchpad\FastForms::formDropzone('file-dropzone', route('ajax.images.dropzone.upload')) }}

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
                                    <label>Filename</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-file fa-lg"></i></span>
                                        <input type="text" id="filename" name="filename" value="'. old('filename', (!empty($image->filename) ? $image->filename : '')) .'" readonly="true" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>'.
                        ( !empty($image->filename) ? ('
                        <div class="image-preview-container">
                            <img src="'. (!empty($image->filename) ? Storage::disk('s3')->url($image->filename) : '') .'" class="image-preview" />
                        </div>') : '' ) .'
                        <hr/>',
            ]
        ]) 
    }}

@endsection

@section('custom-footer-js')
    <script>
        Dropzone.autoDiscover = false;

        $(function(){
            var kmlDropzone = new Dropzone('#file-dropzone', {
                maxFiles: 1,
                maxFilesize: 8, // MB
                acceptedFiles: '.png, .jpg',
                paramName: 'image_file',
                addRemoveLinks: false,
                dictDefaultMessage: '<h3>Click or drag files here to upload</h3><p>Please note that you can only upload one file. Also, if you have an existing file with this same name it will be deleted.</p>',
                headers: {
                    'X-CSRF-Token': Laravel.csrfToken
                },
                init: function(){
                    this.on('success', function(file, response){
                        document.getElementById('filename').value = response.s3Name;
                    });

                    this.on('removedfile', function(file, response){
                        removeFile();
                    });

                    this.on('error', function(file, response, xhr){
                        this.defaultOptions.error(file, response.message); 
                        console.log (response);
                        console.log (xhr);
                    });
                }
            });

            var removeFile = function removeFile(){
                var filenameField = document.getElementById('filename');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('ajax.images.dropzone.delete') }}',
                    data: {id: '{{ !empty($image->id) ? $image->id : null }}', filename: filenameField.value, _token: Laravel.csrfToken},
                    dataType: 'json'
                }).done(function(response){
                    filenameField.value = '';
                    kmlDropzone.removeAllFiles( true );
                });
            }
        });

    </script>
@endsection