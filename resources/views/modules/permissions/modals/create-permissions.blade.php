<x-modal id="modal-create-permissions">
    <x-slot name="title"><em class="si si-flag"></em> Crear Permiso</x-slot>

    <x-slot name="content">
        <x-form method="POST" action="/admin/accounts/permissions" name="form-create-permissions">
            @include('modules.permissions.modals.form.create-permissions')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendCreatePermission.Send()" text="Guardar"></x-form-button-to-accept>
    </x-slot>
</x-modal>
