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

    <x-admin.plugins.breadcrumb>
        <li class="breadcrumb-item">
            <a href="#">{{ __('menu.specials') }}</a>
        </li>
    </x-admin.plugins.breadcrumb>

    <div id="tableMain">
        @include('pages.admin.specials.module.partials.table')
    </div>
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>

    <!-- Modals -->
    @include('pages.admin.specials.module.modals.create')
    @include('pages.admin.specials.module.modals.update')
    @include('pages.admin.specials.module.modals.users')
    @include('pages.admin.specials.module.modals.files')
    @include('pages.admin.specials.module.modals.status')
    @include('pages.admin.specials.module.modals.url')
    @include('pages.admin.specials.module.modals.alliedmedia')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/specials/module/all.js') }}"></script>
@endpush