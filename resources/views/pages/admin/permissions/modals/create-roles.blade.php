<x-admin.modals.modal id="modal-create-roles">
    <x-slot name="title"><em class="fa fa-key"></em> Nuevo role</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="POST" action="/admin/accounts/roles" name="form-create-role">
            @include('pages.admin.permissions.modals.form.create-roles')
        </x-admin.forms.form>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="SendCreateRole.Send()" text="Guardar"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
