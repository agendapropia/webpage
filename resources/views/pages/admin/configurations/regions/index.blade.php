@extends('layouts.admin.app')

@section('page_title', __('menu.configurations-regions'))
@section('navbar_title', __('menu.configurations-regions'))
@section('navbar_title_icon')
    <em class="fa fa-location-arrow mr-2"></em>
@endsection

<!-- menu -->
@section('menu_configurations', 'active')
@section('menu_configurations_collapse', 'show')
@section('menu_configurations_regions', 'active')

@section('content')

    <!-- Breadcrumb -->
    <x-admin.plugins.breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.configurations') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('menu.configurations-regions') }}</li>
    </x-admin.plugins.breadcrumb>

    <!-- Page Content -->
    <div id="tableMain">
        @include('pages.admin.configurations.regions.partials.table')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>

    <!-- Modals -->
    @include('pages.admin.configurations.regions.modals.create')
    @include('pages.admin.configurations.regions.modals.update')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/configurations/regions/all.js') }}"></script>
@endpush