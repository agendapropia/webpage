<x-admin.modals.modal id="modal-copy-main">
    <x-slot name="title"><em class="fa fa-copy mr-2"></em>Remplazar contenido</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="POST" action="/admin/specials/{slug}/contents/copies" name="form-copy-main">
            @include('pages.admin.specials.contents.form.copy')
            <x-admin.forms.form-input-hidden name="language_id"></x-admin.forms.form-input-hidden>
        </x-admin.forms.form>
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
        <x-admin.forms.form-button-danger action="ReplaceContent()" icon="fa-copy" text="Remplazar contenido"></x-admin.forms.form-button-to-accept>
    </x-slot>
</x-admin.modals.modal>
