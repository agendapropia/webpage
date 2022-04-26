<x-modal-alert id="modal-status-user" title="Cambiar el Estado">
    <x-slot name="content_icon"></x-slot>
    <x-slot name="content">
        ¿Esta seguro que quiere <span class="font-weight-bold label-query"></span> a <span class="font-weight-bold label-user"></span>?
    </x-slot>
    <x-slot name="content_title"><span class="font-weight-bold label-query"></span> usuario</x-slot>
    <x-slot name="footer">
        <x-form-button-to-accept data-dismiss="modal" buttonClass="button-status-send" text="Aceptar" action="ButtonStatus()"></x-form-button-to-accept>
        <x-form-button-cancel data-dismiss="modal" text="Cerrar"></x-form-button-cancel>
    </x-slot>
</x-modal-alert>