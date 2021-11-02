@extends('layouts.backend', ['title' => $title])
@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2multiple').select2();
    });
</script>
@endpush
@section('content')
@include('alert')
<div class="card">
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        <form action="{{ route('bands.edit', $band) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            @include('bands.parsial.form-control')
        </form>
    </div>
</div>
@endsection