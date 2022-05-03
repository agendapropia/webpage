<x-modal id="modal-create-user">
    <x-slot name="title"><em class="fa fa-user mr-2"></em>Crear Usuario</x-slot>

    <x-slot name="content">
        <x-form method="POST" action="/admin/accounts/users" name="form-create-user">
            @include('modules.users.form.create')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendCreateUser.Send()" text="Crear usuario"></x-form-button-to-accept>
    </x-slot>
</x-modal>
