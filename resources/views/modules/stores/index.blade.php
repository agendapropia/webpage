@extends('layouts.app')

@section('page_title', __('menu.stores-stores'))
@section('navbar_title', __('menu.stores-stores'))

<!-- menu -->
@section('menu_store_manager', 'active')
@section('menu_store_manager_collapse', 'show')
@section('menu_store_manager_stores', 'active')

@section('content')

    <!-- Breadcrumb -->   
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.stores-manager') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('menu.stores-stores') }}</li>
    </x-breadcrumb>

    <!-- Page Content -->
    <div id="tableStores">
        @include('modules.stores.partials.table')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.footers.auth')
    </div>

    <!-- Modals -->
    @include('modules.stores.modals.create')
    @include('modules.stores.modals.update')
    @include('modules.stores.modals.status')
    @include('modules.stores.modals.schedule')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/stores/all.js') }}"></script>
@endpush