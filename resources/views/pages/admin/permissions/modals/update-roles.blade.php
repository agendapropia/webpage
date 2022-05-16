<x-admin.modals.modal id="modal-update-roles">
    <x-slot name="title"><em class="fa fa-key"></em> Actualizar Roles</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="PUT" action="/admin/accounts/roles" name="form-update-roles">
            <x-admin.forms.form-input-hidden name="id"></x-admin.forms.form-input-hidden>
            @include('pages.admin.permissions.modals.form.create-roles')
        </x-admin.forms.form>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="SendRolesUpdate.Send()" text="Guardar"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
