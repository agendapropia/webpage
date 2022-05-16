<x-admin.modals.modal id="modal-create-user">
    <x-slot name="title"><em class="fa fa-user mr-2"></em>Crear Usuario</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="POST" action="/admin/accounts/users" name="form-create-user">
            @include('pages.admin.users.form.create')
        </x-admin.forms.form>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="SendCreateUser.Send()" text="Crear usuario"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
