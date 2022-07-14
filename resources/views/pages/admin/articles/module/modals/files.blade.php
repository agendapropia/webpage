<x-admin.modals.modal id="modal-utils-imagen-selections" footerClass="no-padding">
    <x-slot name="title"><em class="fa fa-image mr-2"></em>Imágenes</x-slot>

    <x-slot name="content">
        <x-admin.plugins.upload-s3 class="div-files-class">
            <x-admin.forms.form-input-select class="no-padding-mobile" label="Tipo de imagen" name="image_type" desciption="Selecciona un el tipo de imagen a cargar" required="true">
                <option value="1">Portada</option>
                <option value="2">Fotografía para resumen</option>
            </x-admin.forms.form-input-select>
        </x-admin.plugins.upload-s3>
    </x-slot>

</x-admin.modals.modal>
