<x-modal-alert id="modal-status-store" title="Cambiar el Estado">
    <x-slot name="bg_gradient"></x-slot>
    <x-slot name="content_icon"></x-slot>
    <x-slot name="content">
        ¿Esta seguro que quiere <span class="font-weight-bold label-query"></span> la tienda <span class="font-weight-bold label-store"></span>?
    </x-slot>
    <x-slot name="content_title"><span class="font-weight-bold label-query"></span> tienda</x-slot>
    <x-slot name="footer">
        <x-form-button-to-accept data-dismiss="modal" text="Aceptar" action="ButtonStatus()"></x-form-button-to-accept>
        <x-form-button-cancel data-dismiss="modal" text="Cerrar"></x-form-button-cancel>
    </x-slot>
</x-modal-alert>