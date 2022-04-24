<x-modal-alert id="modal-status-menu-topping" title="Cambiar el Estado">
    <x-slot name="content_icon"></x-slot>
    <x-slot name="content_title"><span class="font-weight-bold label-query"></span> topping</x-slot>
    <x-slot name="content">
        ¿Esta seguro que quiere <span class="font-weight-bold label-query"></span> el topping <span class="font-weight-bold label-topping"></span>?
    </x-slot>
    <x-slot name="footer">
        <x-form-button-to-accept data-dismiss="modal" buttonClass="button-status-send" text="Aceptar" action="ButtonStatusAction()"></x-form-button-to-accept>
        <x-form-button-cancel data-dismiss="modal" text="Cerrar"></x-form-button-cancel>
    </x-slot>
</x-modal-alert>