<x-modal id="modal-assign-permissions">
    <x-slot name="title"><em class="fa fa-flag"></em> Asignar permisos, asignar permissos al role "<strong class="name_role"></strong>"</x-slot>

    <x-slot name="content">
        @include('modules.permissions.modals.tables.table-permissions')
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendDataPermissionsRoles()" text="Guardar"></x-form-button-to-accept>
    </x-slot>
</x-modal>