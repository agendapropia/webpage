<x-admin.modals.modal id="modal-utils-imagen-selections">
    <x-slot name="title"><em class="fa fa-image mr-2"></em>Imágenes</x-slot>

    <x-slot name="content">
        
        <x-admin.forms.form-input-select label="Tipo de imagen" name="image_type" desciption="Selecciona un el tipo de imagen a cargar" required="true">
            <option value="1">Portada</option>
            <option value="2">Fotografía para resumen</option>
        </x-admin.forms.form-input-select>

        <div class="div-files-class">
            <div id="upload-s3">
                <ul class="upload-s3-list result"></ul>
                <div id="photos_error">
                    <input id="file" name="file" type="file" multiple style="display: none;">
                </div>
                <div class="upload-s3-help">
                    * Puedes arrastrar y soltar para organizar las fotos.<br>
                    * Los formatos aceptados son .jpg, .gif y .png.<br>
                    * El tamaño máximo permitido para los archivos es 10 MB.
                </div>

                <div class="modal-edit">
                    <div class="form-edit row">
                        <x-admin.forms.form-input-text
                            label="Nombre" 
                            name="name" 
                            placeholder="Nombre del archivo" 
                            required="true"
                            description="Este campo indica el nombre interno del archivo.">
                        </x-admin.forms.form-input-text>

                        <x-admin.forms.form-search-by-autocomplete 
                            divClass="authorSelect" 
                            label="Autor" 
                            fieldName="author_id" 
                            fieldPlaceholder="Autores">
                        </x-form-search-by-autocomplete>

                        <x-admin.forms.form-input-textarea
                            label="Descripción" 
                            name="description" 
                            placeholder="Descripción del archivo" >
                        </x-admin.forms.form-input-textarea>
                    </div>
                </div>

                <div class="button-controls">
                    <div class="edit">
                        <x-admin.forms.form-button-default text="Volver" buttonClass="btn-edit-back"></x-admin.forms.form-button-default>
                        <x-admin.forms.form-button-primary text="Guardar" buttonClass="btn-edit-save"></x-admin.forms.form-button-primary>
                    </div>
                    
                    <div class="main">
                        <x-admin.forms.form-button-success icon="fa-paperclip" text="Adjuntar Archivos" buttonClass="btn-upload"></x-admin.forms.form-button-success>
                        <x-admin.forms.form-button-primary icon="fa-cloud-upload" text="Guardar" buttonClass="btn-save-files3 pull-right"></x-admin.forms.form-button-primary>
                    </div>
                </div>

                <div class="overlay overlay-modal" style="display: none;">
                    <div class="content">
                        <em class="fa fa-3x fa-cog fa-spin"></em>
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
                        <div class="progress-bar" style="width:0%"></div>
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
       

        
    </x-slot>

        
</x-admin.modals.modal>
