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

    <!-- Modals -->
    <div class="modals-files"></div>
    <script id="template-file-modal" type="text/x-custom-template">
    <div
        class="modal fade modal-table-gear"
        tabindex="-1"
        role="dialog"
        style="display: none"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background: #fdfdfd">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <em class="fa fa-image mr-2"></em>Imagenes
                        <span class="modal-subtitle"></span>
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="upload-s3" class="div-files-class">
                        <div class="modal-files" style="">
                            <ul class="upload-s3-list result ui-sortable"></ul>
                            <div id="photos_error">
                                <input
                                    id="file"
                                    name="file"
                                    type="file"
                                    multiple=""
                                    style="display: none"
                                />
                            </div>
                            <div class="upload-s3-help">
                                * Puedes arrastrar y soltar para organizar las
                                fotos.<br />
                                * El tamaño máximo permitido para los archivos es 20
                                MB.
                            </div>
                        </div>

                        <div class="modal-edit" style="display: none">
                            <div class="form-edit row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label" for=""
                                        >Nombre</label
                                    >
                                    <span class="is-required">*</span>
                                    <input
                                        type="text"
                                        class="form-control form-control-sm"
                                        name="name"
                                        placeholder="Nombre del archivo"
                                        autocomplete="off"
                                    />
                                    <small
                                        id="emailHelp"
                                        class="form-text text-muted"
                                    >
                                        Este campo indica el nombre interno del
                                        archivo.
                                        <div class="label-error"></div>
                                    </small>
                                </div>

                                <div
                                    class="form-group form-group-search-autocomplete authorSelect col-md-6"
                                    id="authorSelect"
                                >
                                    <label class="form-control-label" for=""
                                        >Autor</label
                                    >
                                    <span class="is-required"></span>
                                    <input
                                        type="hidden"
                                        class="input-hidden"
                                        name="author_id"
                                        value=""
                                    />
                                    <div class="group-field">
                                        <input
                                            type="text"
                                            class="form-control input-search form-control-sm"
                                            placeholder="Autores"
                                            autocomplete="off"
                                        />
                                        <em class="icon-loading fa fa-search"></em>
                                        <ul
                                            class="items"
                                            style="display: none"
                                        ></ul>
                                        <div class="selected-items"></div>
                                    </div>
                                    <div class="label-error"></div>
                                </div>

                                <div class="form-group col-md-6 col-md-12">
                                    <label class="form-control-label" for=""
                                        >Descripción</label
                                    >
                                    <span class="is-required"></span>
                                    <textarea
                                        class="form-control"
                                        name="description"
                                        placeholder="Descripción del archivo"
                                    ></textarea>
                                    <div class="label-error"></div>
                                </div>
                            </div>
                        </div>

                        <div class="button-controls">
                            <div class="edit" style="display: none">
                                <button
                                    type="button"
                                    id=""
                                    class="btn btn-default btn-edit-back"
                                    onclick=""
                                >
                                    <em class="fa fa-angle-left"></em> Volver
                                </button>
                                <button
                                    type="button"
                                    id=""
                                    class="btn btn-primary btn-edit-save"
                                    onclick=""
                                    data-id="1"
                                >
                                    <em class="fa fa-save"></em> Guardar
                                </button>
                            </div>

                            <div class="main" style="">
                                <button
                                    type="button"
                                    id=""
                                    class="btn btn-success btn-upload"
                                    onclick=""
                                >
                                    <em class="fa fa-paperclip"></em> Adjuntar
                                    Archivos
                                </button>
                                <button
                                    type="button"
                                    id=""
                                    class="btn btn-primary btn-save-files3 pull-right"
                                    onclick=""
                                    disabled=""
                                >
                                    <em class="fa fa-cloud-upload"></em> Guardar
                                </button>
                            </div>
                        </div>

                        <div class="overlay overlay-div" style="display: none">
                            <div class="content">
                                <i class="fa fa-3x fa-spinner fa-spin"></i>
                            </div>
                        </div>
                    </div>

                    <div class="hide">
                        <div id="template-file">
                            <div class="upload-file">
                                <div class="image"></div>
                                <div class="content">
                                    <div class="name">Nombre Archivo</div>
                                    <div class="source">source.png</div>
                                    <div class="author">Autor</div>
                                    <div class="description">Descripción</div>
                                </div>
                            </div>
                            <div class="progress active">
                                <div class="progress-bar" style="width: 0%"></div>
                            </div>
                            <div class="control">
                                <div class="btn-control btn-edit">
                                    <em class="fa fa-pencil"></em>
                                </div>
                                <div class="btn-control btn-delete">
                                    <em class="fa fa-remove"></em>
                                </div>
                            </div>
                            <div class="error">
                                <button class="btn btn-success btn-xs preload">
                                    <em class="fa fa-cloud-upload"></em> Reintentar
                                </button>
                                <button class="btn btn-danger btn-xs btn-delete">
                                    <em class="fa fa-trash"></em> Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer no-padding"></div>
                <div class="overlay overlay-div" style="display: none">
                    <div class="content">
                        <i class="fa fa-3x fa-spinner fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

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