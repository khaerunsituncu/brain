@extends('layouts.backend', ['title' => $title])
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
                <tr>
                    <td>{{ $genre->id }}</td>
                    <td>{{ $genre->name }}</td>
                    <td>
                        <a href="{{ route('genres.edit', $genre) }}" class="btn btn-sm btn-primary">Edit</a>
                        <div endpoint={{ route('genres.destroy', $genre) }} class="delete d-inline"></div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $genres->links() }}
@endsection