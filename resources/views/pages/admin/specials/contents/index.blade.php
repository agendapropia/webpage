@extends('layouts.admin.app')

@section('page_title', $special->name)
@section('navbar_title', $special->name)
@section('navbar_title_icon')
    <em class="fa fa-file-text mr-2"></em>
@endsection

<!-- menu -->
@section('menu_specials', 'active')
@section('menu_specials_collapse', 'show')
@section('menu_specials_item', 'active')

@section('content')
    <x-admin.plugins.breadcrumb>
        <x-admin.plugins.breadcrumb-item href="{{ route('module-special') }}">{{ __('menu.specials') }}</x-admin.plugins.breadcrumb-item>
        <x-admin.plugins.breadcrumb-item>{{ $special->name }}</x-admin.plugins.breadcrumb-item>
    </x-admin.plugins.breadcrumb>

    <div class="container-fluid mt--6" id="div-update-main">
        <input type="hidden" id="special_id" value="{{ $special->id }}">
        <input type="hidden" id="slug" value="{{ $special->slug }}">
        <input type="hidden" name="id" value="">

        <x-admin.layouts.card-complete divClass="div-card-header p-1">
            <x-admin.forms.form-input-select label="Idioma" name="language_id" required elementBasic fieldWidth="col-md-2 form-horizontal">
                @foreach ($languages as $lang)
                    <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                @endforeach
            </x-admin.forms.form-input-select>
            <x-admin.forms.form-button-primary buttonClass="special-btn-save" id="special-btn-save" text="Guardar"></x-admin.forms.form-button-primary>
        </x-admin.layouts.card-complete>


        <!-- <x-admin.layouts.card-medium divClass="div-card-content mt--3 hide">
            <x-admin.forms.form method="POST" action="/admin/specials/contents" name="form-update-main">
                @include('pages.admin.specials.contents.form.content')
            </x-admin.forms.form>
        </x-admin.layouts.card-medium> -->

        <x-admin.layouts.card-complete divClass="div-card-body mt--3 pt-10">
            <div id="editorjs"></div>
        </x-admin.layouts.card-complete>
    </div>
    
    <div class="container-fluid">
        @include('layouts.admin.footers.auth')
    </div>
@endsection

@push('js-after')
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-paragraph-with-alignment@3.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/raw"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@2.0.2/dist/table.min.js"></script>
    <script src="{{ mix('js/modules/specials/contents/all.js') }}"></script>
@endpush