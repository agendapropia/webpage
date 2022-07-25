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
                            <div class="form-group no-padding-mobile col-md-6 focused">
                                <label class="form-control-label">Tipo de imagen</label>
                                <span class="is-required">*</span>
                                <select class="form-control form-control-sm " name="image_type" data-placeholder="" autocomplete="off">
                                    <option value="1">Fotografías</option>
                                    <option value="2">Galería</option>
                                </select>
                                <small class="form-text text-muted">  
                                    <div class="label-error"></div>
                                </small>
                            </div>
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

<script id="template-embed-html-modal" type="text/x-custom-template">
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
                        <em class="ni ni-html5 mr-2"></em>Incrustar html (Embeber)
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
                    <div  class="row">
                        <div class="form-group no-padding-mobile col-md-12 focused">
                            <label class="form-control-label">Url</label>
                            <span class="is-required">*</span>
                            <input type="text" class="form-control form-control-sm " name="url" placeholder="Ingresa la URL" autocomplete="off"></input>
                            <small class="form-text text-muted">  
                                <div class="label-error"></div>
                            </small>
                        </div>

                        <div class="form-group no-padding-mobile col-md-6 focused">
                            <label class="form-control-label">Altura</label>
                            <span class="is-required">*</span>
                            <input type="text" class="form-control form-control-sm " name="height_full" placeholder="Altura del contendor" autocomplete="off" value="600"></input>
                            <small class="form-text text-muted">  
                                <div class="label-error"></div>
                            </small>
                        </div>

                        <div class="form-group no-padding-mobile col-md-6 focused hide">
                            <label class="form-control-label">Altura mobile</label>
                            <span class="is-required">*</span>
                            <input type="text" class="form-control form-control-sm " name="height_mobile" placeholder="Altura mobile del contendor" autocomplete="off" value="400"></input>
                            <small class="form-text text-muted">  
                                <div class="label-error"></div>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-primary btn-action">
                        <em class="fa fa-save"></em> Guardar
                    </button>
                </div>
                <div class="overlay overlay-div" style="display: none">
                    <div class="content">
                        <i class="fa fa-3x fa-spinner fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>

<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-paragraph-with-alignment@3.0.0"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/table@2.0.2/dist/table.min.js"></script>