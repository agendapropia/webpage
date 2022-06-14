@extends('layouts.admin.app')

@section('page_title', __('menu.accounts-users'))
@section('navbar_title', __('menu.accounts-users'))

<!-- menu -->
@section('menu_account', 'active')
@section('menu_account_collapse', 'show')
@section('menu_account_users', 'active')

@section('content')

    <!-- Breadcrumb -->   
    <x-admin.plugins.breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.accounts') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('menu.accounts-users') }}</li>
    </x-admin.plugins.breadcrumb>

    <!-- Page Content -->
    <div id="tableUsers">
        @include('pages.admin.users.partials.table')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>

    <!-- Modals -->
    @include('pages.admin.users.modals.create')
    @include('pages.admin.users.modals.update')
    @include('pages.admin.users.modals.status')
    @include('pages.admin.users.modals.assign-roles')
    @include('pages.admin.users.modals.files')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/users/all.js') }}"></script>
@endpush