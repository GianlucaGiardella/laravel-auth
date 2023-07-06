@extends('admin.layouts.base')

@section('contents')
    <h1>Posts</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Image</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->url_image }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.posts.show', ['post' => $post->id]) }}">View</a>
                        <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Edit</a>
                        <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post"
                            class="d-inline-block">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection
