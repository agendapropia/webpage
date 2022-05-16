<x-admin.modals.modal id="modal-create-permissions">
    <x-slot name="title"><em class="si si-flag"></em> Crear Permiso</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="POST" action="/admin/accounts/permissions" name="form-create-permissions">
            @include('pages.admin.permissions.modals.form.create-permissions')
        </x-admin.forms.form>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="SendCreatePermission.Send()" text="Guardar"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
