<x-modal id="modal-update-store">
    <x-slot name="title"><em class="fa fa-building mr-1"></em> Actualizar tienda</x-slot>

    <x-slot name="content">
        <x-form method="PUT" action="/store-manager/stores" name="form-update-store">
            <x-form-input-hidden name="id"></x-form-input-hidden>
            @include('modules.stores.modals.form.create')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendStoreUpdate.Send()" text="Actualizar tienda"></x-form-button-to-accept>
    </x-slot>
</x-modal>
