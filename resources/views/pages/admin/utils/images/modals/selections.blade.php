<x-admin.modals.modal id="modal-utils-imagen-selections">
    <x-slot name="title"><em class="fa fa-image mr-2"></em>Imágenes</x-slot>

    <x-slot name="content">    
            
        <div id="upload-s3">
                <ul class="upload-s3-list sortable result">
                </ul>

                <div id="photos_error">
                    <input id="file" name="file" type="file" multiple style="display: none;">
                </div>
        
                <div class="upload-s3-help">
                    * Puedes arrastrar y soltar para organizar las fotos.<br>
                    * Los formatos aceptados son .jpg, .gif y .png.<br>
                    * El tamaño máximo permitido para los archivos es 10 MB.
                </div>
        </div>
            
        <div class="hide">
            <div id="template-file">
                <div class="upload-file">
                    <div class="image"> 
                    </div>
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
                    <button class="btn btn-danger btn-xs delete">
                        <em class="fa fa-trash"></em> Cancelar
                    </button>
                </div>
            </div>
        </div>

    </x-slot>

    <x-slot name="footer">
        <button class="btn btn-success pull-left btn-upload" style="width:140px;"> Subir Archivos</button>
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
    </x-slot>
</x-admin.modals.modal>
