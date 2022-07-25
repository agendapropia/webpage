@extends('layouts.admin.app')

@section('page_title', $article->name)
@section('navbar_title', $article->name)
@section('navbar_title_icon')
    <em class="fa fa-file-text mr-2"></em>
@endsection

<!-- menu -->
@section('menu_specials', 'active')
@section('menu_specials_collapse', 'show')
@section('menu_articles_item', 'active')

@section('content')
    <x-admin.plugins.breadcrumb>
        <x-admin.plugins.breadcrumb-item href="{{ route('module-article') }}">{{ __('menu.articles') }}</x-admin.plugins.breadcrumb-item>
        <x-admin.plugins.breadcrumb-item>{{ $article->name }}</x-admin.plugins.breadcrumb-item>
    </x-admin.plugins.breadcrumb>

    <div class="container-fluid mt--6" id="div-update-main">
        <input type="hidden" id="article_id" value="{{ $article->id }}">
        <input type="hidden" id="slug" value="{{ $article->slug }}">
        <input type="hidden" name="id" value="">

        <x-admin.layouts.card-complete divClass="div-card-header p-1">
            <x-admin.forms.form-input-select label="Idioma" name="language_id" required elementBasic fieldWidth="col-md-2 form-horizontal">
                @foreach ($languages as $lang)
                    <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                @endforeach
            </x-admin.forms.form-input-select>
            <x-admin.forms.form-button-primary buttonClass="btn-sm article-btn-details" id="article-btn-details" text="Detalles" icon="fa-level-down"></x-admin.forms.form-button-primary>
            <x-admin.forms.form-button-default buttonClass="btn-sm article-btn-copy" id="article-btn-details" text="" icon="fa-copy"></x-admin.forms.form-button-default>
            <x-admin.forms.form-button-success buttonClass="special-btn-save" id="article-btn-save" text="Guardar"></x-admin.forms.form-button-success>
        </x-admin.layouts.card-complete>


        <x-admin.layouts.card-complete divClass="div-card-content article-div-details mt--3 hide">
            <x-admin.forms.form method="POST" action="/admin/articles/contents" name="form-update-main">
                @include('pages.admin.articles.contents.form.content')
            </x-admin.forms.form>
        </x-admin.layouts.card-complete>

        <x-admin.layouts.card-complete divClass="div-card-body mt--3 pt-10">
            <div id="editorjs"></div>
        </x-admin.layouts.card-complete>
    </div>
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>

    <!-- Modals -->
    @include('pages.admin.articles.contents.modals.copy')

    <div class="modals-editorjs"></div>
@endsection

@push('js-after')
    @include('pages.admin.utils.editorjs')
    <script src="{{ mix('js/modules/utils/editorjs/all.js') }}"></script>
    <script src="{{ mix('js/modules/articles/contents/all.js') }}"></script>
@endpush