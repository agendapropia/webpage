@extends('layouts.admin.app')

@section('page_title', __('menu.accounts-users'))
@section('navbar_title', __('menu.accounts-users'))

<!-- menu -->
@section('menu_account', 'active')
@section('menu_account_collapse', 'show')
@section('menu_account_users', 'active')

@section('content')

    <!-- Breadcrumb -->   
    <x-breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.accounts') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('menu.accounts-users') }}</li>
    </x-breadcrumb>

    <!-- Page Content -->
    <div id="tableUsers">
        @include('modules.users.partials.table')
    </div>
    <!-- END Page Content -->
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>

    <!-- Modals -->
    @include('modules.users.modals.create')
    @include('modules.users.modals.update')
    @include('modules.users.modals.status')
    @include('modules.users.modals.assign-roles')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/users/all.js') }}"></script>
@endpush