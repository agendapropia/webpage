@extends('layouts.admin.app')

@section('page_title', __('menu.articles'))
@section('navbar_title', __('menu.articles'))
@section('navbar_title_icon')
    <em class="fa fa-file-text mr-2"></em>
@endsection

<!-- menu -->
@section('menu_specials', 'active')
@section('menu_specials_collapse', 'show')
@section('menu_articles_item', 'active')

@section('content')
    <x-admin.plugins.breadcrumb>
        <li class="breadcrumb-item"><a href="#">{{ __('menu.articles') }}</a></li>
    </x-admin.plugins.breadcrumb>

    <div id="tableMain">
        @include('pages.admin.articles.module.partials.table')
    </div>
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>

    <!-- Modals -->
    @include('pages.admin.articles.module.modals.create')
    @include('pages.admin.articles.module.modals.update')
    @include('pages.admin.articles.module.modals.users')
    @include('pages.admin.articles.module.modals.files')
    @include('pages.admin.articles.module.modals.status')
    @include('pages.admin.articles.module.modals.url')
@endsection

@push('js-after')
    <script src="{{ mix('js/modules/articles/module/all.js') }}"></script>
@endpush