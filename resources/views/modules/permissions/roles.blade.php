@extends('layouts.app')

@section('page_title', __('menu.accounts-roles'))
@section('navbar_title', __('menu.accounts-roles'))

<!-- menu -->
@section('menu_account', 'active')
@section('menu_account_collapse', 'show')
@section('menu_account_roles', 'active')

@section('content')

    <!-- Breadcrumb -->   
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.accounts') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('menu.accounts-roles') }}</li>
    </x-breadcrumb>

    <!-- Page Content -->
    <div id="tableRoles">
        @include('modules.permissions.partials.table-roles')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.footers.auth')
    </div>

    <!-- Modals -->
    @include('modules.permissions.modals.create-roles')
    @include('modules.permissions.modals.update-roles')
    @include('modules.permissions.modals.assign-permissions')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/permissions/roles-all.js') }}"></script>
@endpush