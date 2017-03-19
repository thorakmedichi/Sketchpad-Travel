@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Images')

@section('panel-content')

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Preview</th>
                <th>Name</th>
                <th>Filename</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
            <tr>
                <td></td>
                <td>{{ $image->name }}</td>
                <td>{{ $image->filename }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection