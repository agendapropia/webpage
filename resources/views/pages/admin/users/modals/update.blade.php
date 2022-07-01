<x-admin.modals.modal id="modal-update-user">
    <x-slot name="title"><em class="fa fa-user mr-1"></em> Actualizar Usuario</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="PUT" action="/admin/accounts/users" name="form-update-user">
            <x-admin.forms.form-input-hidden name="id"></x-admin.forms.form-input-hidden>
            @include('pages.admin.users.form.create')
        </x-admin.forms.form>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="SendUserUpdate.Send()" text="Actualizar usuario"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
