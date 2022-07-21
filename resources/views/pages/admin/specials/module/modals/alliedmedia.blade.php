<x-admin.modals.modal id="modal-special-alliedmedia">
    <x-slot name="title"><em class="fa fa-user mr-2"></em>Medios aliados</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="POST" action="/admin/specials/allied-media/internal" name="form-special-alliedmedia">
            <x-admin.forms.form-input-hidden name="special_id"></x-admin.forms.form-input-hidden>
            @include('pages.admin.specials.module.form.alliedmedia')
        </x-admin.forms.form>

        @include('pages.admin.specials.module.partials.table-alliedmedia')
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
    </x-slot>
</x-admin.modals.modal>
