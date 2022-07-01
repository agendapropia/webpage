<x-admin.modals.modal id="modal-update-main">
    <x-slot name="title"><em class="fa fa-address-book mr-1"></em> Actualizar Medio aliado</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="PUT" action="/admin/specials/allied-media" name="form-update-main">
            <x-admin.forms.form-input-hidden name="id"></x-admin.forms.form-input-hidden>
            @include('pages.admin.specials.alliedmedia.form.create')
        </x-admin.forms.form>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="ActionMainUpdateSend.Send()" text="Actualizar"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
