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
        <form action="{{ route('bands.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('bands.parsial.form-control', ['submit' => 'Create'])
        </form>
    </div>
</div>
@endsection