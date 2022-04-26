<x-modal id="modal-update-user">
    <x-slot name="title"><em class="fa fa-user mr-1"></em> Actualizar Usuario</x-slot>

    <x-slot name="content">
        <x-form method="PUT" action="/accounts/users" name="form-update-user">
            <x-form-input-hidden name="id"></x-form-input-hidden>
            @include('modules.users.form.create')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendUserUpdate.Send()" text="Actualizar usuario"></x-form-button-to-accept>
    </x-slot>
</x-modal>
