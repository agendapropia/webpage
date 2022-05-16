<x-admin.modals.modal id="modal-assign-permissions">
    <x-slot name="title"><em class="fa fa-flag"></em> Asignar permisos, asignar permissos al role "<strong class="name_role"></strong>"</x-slot>

    <x-slot name="content">
        @include('pages.admin.permissions.modals.tables.table-permissions')
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="SendDataPermissionsRoles()" text="Guardar"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>