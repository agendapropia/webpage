<x-admin.modals.modal id="modal-assign-roles">
    <x-slot name="title"><em class="ni ni-lock-circle-open"></em> Asignar roles al usuario "<strong class="name_user"></strong>"</x-slot>

    <x-slot name="content">
        @include('pages.admin.users.partials.table-roles')
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="SendDataUserRoles()" text="Guardar cambios"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
