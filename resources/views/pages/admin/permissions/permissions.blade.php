@extends('layouts.admin.app')

@section('page_title', __('menu.accounts-permissions'))
@section('navbar_title', __('menu.accounts-permissions'))

<!-- menu -->
@section('menu_account', 'active')
@section('menu_account_collapse', 'show')
@section('menu_account_permissions', 'active')

@section('content')

    <!-- Breadcrumb -->   
    <x-admin.plugins.breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.accounts') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('menu.accounts-permissions') }}</li>
    </x-admin.plugins.breadcrumb>

    <!-- Page Content -->
    <div id="tablePermissions">
        @include('pages.admin.permissions.partials.table-permissions')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>

    <!-- Modals -->
    @include('pages.admin.permissions.modals.create-permissions')
    @include('pages.admin.permissions.modals.update-permissions')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/permissions/permissions-all.js') }}"></script>
@endpush