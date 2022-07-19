<x-admin.modals.modal id="modal-status-main" contentClass="modal-center" modalBackground="#ededed">
    <x-slot name="title"><em class="fa fa-file-text mr-2"></em>Cambiar estado</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="PATCH" action="/admin/articles/status" name="form-status-main">
            <x-admin.forms.form-input-hidden name="id"></x-admin.forms.form-input-hidden>
            @include('pages.admin.articles.module.form.status')
        </x-admin.forms.form>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-to-accept action="ActionQueryStatusSend()" text="Guardar"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
