@extends('layouts.app')

@section('page_title', __('menu.menu-toppings'))
@section('navbar_title', __('menu.menu-toppings'))

<!-- menu -->
@section('menu_menu', 'active')
@section('menu_menu_collapse', 'show')
@section('menu_menu_toppings', 'active')

@section('content')

    <!-- Breadcrumb -->   
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.menu') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('menu.menu-toppings') }}</li>
    </x-breadcrumb>

    <!-- Page Content -->
    <div id="tableMenuToppings">
        @include('modules.menus.toppings.partials.table')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.footers.auth')
    </div>

    <!-- Modals -->
    @include('modules.menus.toppings.modals.create')
    @include('modules.menus.toppings.modals.update')
    @include('modules.menus.toppings.modals.status')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/menus/toppings/all.js') }}"></script>
@endpush