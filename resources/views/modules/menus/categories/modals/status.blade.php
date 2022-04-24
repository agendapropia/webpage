<x-modal-alert id="modal-status-menu-categories" title="Cambiar el Estado">
    <x-slot name="content_icon"></x-slot>
    <x-slot name="content_title"><span class="font-weight-bold label-query"></span> categoría</x-slot>
    <x-slot name="content">
        ¿Esta seguro que quiere <span class="font-weight-bold label-query"></span> la categoría <span class="font-weight-bold label-categories"></span>?
    </x-slot>
    <x-slot name="footer">
        <x-form-button-to-accept data-dismiss="modal" buttonClass="button-status-send" text="Aceptar" action="ButtonStatusAction()"></x-form-button-to-accept>
        <x-form-button-cancel data-dismiss="modal" text="Cerrar"></x-form-button-cancel>
    </x-slot>
</x-modal-alert>