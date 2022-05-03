<x-modal id="modal-update-permissions">
    <x-slot name="title"><em class="fa fa-flag"></em> Actualizar permiso</x-slot>

    <x-slot name="content">
        <x-form method="PUT" action="/admin/accounts/permissions" name="form-update-permissions">
            <x-form-input-hidden name="id"></x-form-input-hidden>
            @include('modules.permissions.modals.form.create-permissions')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendPermissionsUpdate.Send()" text="Guardar"></x-form-button-to-accept>
    </x-slot>
</x-modal>
