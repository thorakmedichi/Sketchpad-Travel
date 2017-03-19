@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Blogs')

@section('panel-content')

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Author</th>
                <th>Title</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td><a href="{{ route('admin.authors.edit', ['id' => $blog->author_id]) }}">{{ $blog->Author->name }}</a></td>
                <td><a href="{{ route('admin.blogs.edit', ['id' => $blog->id]) }}">{{ $blog->title }}</td>
                <td>{{ $blog->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection