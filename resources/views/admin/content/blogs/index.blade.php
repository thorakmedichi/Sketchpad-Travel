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
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td><a href="{{ route('admin.authors.edit', ['id' => $blog->author_id]) }}">{{ $blog->Author->name }}</a></td>
                <td><a href="{{ route('admin.blogs.edit', ['id' => $blog->id]) }}">{{ $blog->title }}</td>
                <td>{{ $blog->status }}</td>
                <td>
                    <form action="{{ route('admin.blogs.destroy', ['id' => $blog->id]) }}" role="form" method="post">
                        {{ csrf_field() }}{{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger pull-right">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection