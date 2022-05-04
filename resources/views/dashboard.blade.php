@extends('layouts.admin.app')

@section('content')
    @include('layouts.admin.headers.cards')
    
    <div class="container-fluid mt--7">
        @include('layouts.admin.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush