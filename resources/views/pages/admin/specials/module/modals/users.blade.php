<x-admin.modals.modal id="modal-special-users">
    <x-slot name="title"><em class="fa fa-user mr-2"></em>Usuarios</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="POST" action="/admin/specials/users" name="form-special-users">
            <x-admin.forms.form-input-hidden name="special_id"></x-admin.forms.form-input-hidden>
            @include('pages.admin.specials.module.form.users')
        </x-admin.forms.form>

        @include('pages.admin.specials.module.partials.table-users')
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
    </x-slot>
</x-admin.modals.modal>
