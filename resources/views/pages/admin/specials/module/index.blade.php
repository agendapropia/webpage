@extends('layouts.admin.app')

@section('page_title', __('menu.specials'))
@section('navbar_title', __('menu.specials'))
@section('navbar_title_icon')
    <em class="fa fa-file-text mr-2"></em>
@endsection

<!-- menu -->
@section('menu_specials', 'active')
@section('menu_specials_collapse', 'show')
@section('menu_specials_item', 'active')

@section('content')

    <!-- Breadcrumb -->
    <x-admin.plugins.breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.specials') }}</a></li>
    </x-admin.plugins.breadcrumb>

    <!-- Page Content -->
    <div id="tableMain">
        @include('pages.admin.specials.module.partials.table')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>

    <!-- Modals -->
    @include('pages.admin.specials.module.modals.create')
    @include('pages.admin.specials.module.modals.update')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/specials/module/all.js') }}"></script>
@endpush