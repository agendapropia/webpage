<x-modal id="modal-assign-roles">
    <x-slot name="title"><em class="fa fa-key"></em> Asignar roles al usuario "<strong class="name_user"></strong>"</x-slot>

    <x-slot name="content">
        @include('modules.users.partials.table-roles')
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendDataUserRoles()" text="Guardar cambios"></x-form-button-to-accept>
    </x-slot>
</x-modal>
