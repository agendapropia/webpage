<x-modal-alert id="modal-status-user" title="Cambiar el Estado">
    <x-slot name="bg_gradient"> bg-gradient-danger</x-slot>
    <x-slot name="content_icon"></x-slot>
    <x-slot name="content">
        ¿Esta seguro que quiere <span class="font-weight-bold label-query"></span> a <span class="font-weight-bold label-user"></span>?
    </x-slot>
    <x-slot name="content_title"><span class="font-weight-bold label-query"></span> usuario</x-slot>
    <x-slot name="footer">
        <button type="button" class="btn btn-white" onclick="ButtonStatus()">Aceptar</button>
        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Cerrar</button>
    </x-slot>
</x-modal-alert>