@extends('admin.content.single-form-panel')

{{-- Web site Title --}}
@section('title', 'Tags')

@section('panel-content')

    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
            <tr>
                <td><a href="{{ route('admin.tags.edit', ['id' => $tag->id]) }}"><h3>{{ $tag->name }}</h3></td>
                <td>
                    <form action="{{ route('admin.tags.destroy', ['id' => $tag->id]) }}" role="form" method="post">
                        {{ csrf_field() }}{{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger pull-right">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection