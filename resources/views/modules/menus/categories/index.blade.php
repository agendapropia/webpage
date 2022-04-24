@extends('layouts.app')

@section('page_title', __('menu.menu-categories'))
@section('navbar_title', __('menu.menu-categories'))

<!-- menu -->
@section('menu_menu', 'active')
@section('menu_menu_config', 'active')
@section('menu_menu_config_collapse', 'show')
@section('menu_menu_collapse', 'show')
@section('menu_menu_categories', 'active')

@section('content')

    <!-- Breadcrumb -->   
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.menu') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('menu.menu-categories') }}</li>
    </x-breadcrumb>

    <!-- Page Content -->
    <div id="tableMenuCategories">
        @include('modules.menus.categories.partials.table')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.footers.auth')
    </div>

    <!-- Modals -->
    @include('modules.menus.categories.modals.create')
    @include('modules.menus.categories.modals.update')
    @include('modules.menus.categories.modals.status')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/menus/categories/all.js') }}"></script>
@endpush