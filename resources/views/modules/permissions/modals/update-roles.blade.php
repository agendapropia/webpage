<x-modal id="modal-update-roles">
    <x-slot name="title"><em class="fa fa-key"></em> Actualizar Roles</x-slot>

    <x-slot name="content">
        <x-form method="PUT" action="/admin/accounts/roles" name="form-update-roles">
            <x-form-input-hidden name="id"></x-form-input-hidden>
            @include('modules.permissions.modals.form.create-roles')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendRolesUpdate.Send()" text="Guardar"></x-form-button-to-accept>
    </x-slot>
</x-modal>
