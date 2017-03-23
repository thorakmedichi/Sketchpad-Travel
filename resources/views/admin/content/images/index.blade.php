@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Images')

@section('panel-content')

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Name</th>
                <th>Filename</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
            <tr>
                <td>
                    <a href="{{ route('admin.images.edit', ['id' => $image->id]) }}">
                        <img src="{{ Storage::disk('s3')->url($image->filename) }}" class="image-thumbnail"/>
                    </a>
                </td>
                <td><a href="{{ route('admin.images.edit', ['id' => $image->id]) }}">{{ $image->name }}</a></td>
                <td>{{ $image->filename }}</td>
                <td>
                    <form action="{{ route('admin.images.destroy', ['id' => $image->id]) }}" role="form" method="post">
                        {{ csrf_field() }}{{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger pull-right">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

@endsection