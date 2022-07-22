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
            <x-admin.forms.form-button-primary buttonClass="btn-sm special-btn-details" id="special-btn-details" text="Detalles" icon="fa-level-down"></x-admin.forms.form-button-primary>
            <x-admin.forms.form-button-default buttonClass="btn-sm special-btn-copy" id="special-btn-details" text="" icon="fa-copy"></x-admin.forms.form-button-default>
            <x-admin.forms.form-button-success buttonClass="special-btn-save" id="special-btn-save" text="Guardar"></x-admin.forms.form-button-success>
        </x-admin.layouts.card-complete>


        <x-admin.layouts.card-complete divClass="div-card-content special-div-details mt--3 hide">
            <x-admin.forms.form method="POST" action="/admin/specials/contents" name="form-update-main">
                @include('pages.admin.specials.contents.form.content')
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
    @include('pages.admin.specials.contents.modals.copy')

    <div class="modals-files"></div>
@endsection

@push('js-after')
    @include('pages.admin.utils.editorjs')
    <script src="{{ mix('js/modules/utils/editorjs/all.js') }}"></script>
    <script src="{{ mix('js/modules/specials/contents/all.js') }}"></script>
@endpush