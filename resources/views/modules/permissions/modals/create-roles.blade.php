<x-modal id="modal-create-roles">
    <x-slot name="title"><em class="fa fa-key"></em> Nuevo role</x-slot>

    <x-slot name="content">
        <x-form method="POST" action="/accounts/roles" name="form-create-role">
            @include('modules.permissions.modals.form.create-roles')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendCreateRole.Send()" text="Guardar"></x-form-button-to-accept>
    </x-slot>
</x-modal>
