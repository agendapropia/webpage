<x-admin.modals.modal id="modal-create-main">
    <x-slot name="title"><em class="fa fa-address-book mr-2"></em>Crear Medio Aliado</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="POST" action="/admin/specials/allied-media" name="form-create-main">
            @include('pages.admin.specials.alliedmedia.form.create')
        </x-admin.forms.form>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="ActionSendMain.Send()" text="Crear"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
