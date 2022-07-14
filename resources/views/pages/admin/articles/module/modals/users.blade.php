<x-admin.modals.modal id="modal-article-users">
    <x-slot name="title"><em class="fa fa-user mr-2"></em>Usuarios</x-slot>

    <x-slot name="content">
        <x-admin.forms.form method="POST" action="/admin/articles/users" name="form-article-users">
            <x-admin.forms.form-input-hidden name="article_id"></x-admin.forms.form-input-hidden>
            @include('pages.admin.articles.module.form.users')
        </x-admin.forms.form>

        @include('pages.admin.articles.module.partials.table-users')
    </x-slot>

    <x-slot name="footer">
        <x-admin.forms.form-button-cancel text="Cerrar"></x-admin.forms.form-button-accept>
    </x-slot>
</x-admin.modals.modal>
