<x-modal id="modal-create-store">
    <x-slot name="title"><em class="fa fa-building mr-2"></em>Crear tienda</x-slot>

    <x-slot name="content">
        <x-form method="POST" action="/store-manager/stores" name="form-create-store">
            @include('modules.stores.modals.form.create')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendCreateStore.Send()" text="Crear tiendas"></x-form-button-to-accept>
    </x-slot>
</x-modal>
