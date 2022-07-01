@extends('layouts.admin.app')

@section('page_title', __('menu.configurations-alliedmedia'))
@section('navbar_title', __('menu.configurations-alliedmedia'))
@section('navbar_title_icon')
    <em class="fa fa-address-book mr-2"></em>
@endsection

<!-- menu -->
@section('menu_configurations', 'active')
@section('menu_configurations_collapse', 'show')
@section('menu_configurations_alliedmedia', 'active')

@section('content')

    <!-- Breadcrumb -->
    <x-admin.plugins.breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.configurations-alliedmedia') }}</a></li>
    </x-admin.plugins.breadcrumb>

    <!-- Page Content -->
    <div id="tableMain">
        @include('pages.admin.specials.alliedmedia.partials.table')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>

    <!-- Modals -->
    @include('pages.admin.specials.alliedmedia.modals.create')
    @include('pages.admin.specials.alliedmedia.modals.update')
    @include('pages.admin.specials.alliedmedia.modals.files')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/specials/alliedmedia/all.js') }}"></script>
@endpush