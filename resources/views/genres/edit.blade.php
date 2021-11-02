@extends('layouts.backend', ['title' => $title])
@section('content')
    @include('alert')
    <div class="card">
        <div class="card-header">{{ $title }}</div>
        <div class="card-body">
            <form action="{{ route('genres.edit', $genre) }}" method="post">
                @csrf
                @method('put')
                @include('genres.partials.form-control')
            </form>
        </div>
    </div>
@endsection
