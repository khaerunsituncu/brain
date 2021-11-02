@extends('layouts.backend', ['title' => 'Dashboard'])
@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2multiple').select2();
    });
</script>
@endpush
@section('content')
    Dashboard
@endsection