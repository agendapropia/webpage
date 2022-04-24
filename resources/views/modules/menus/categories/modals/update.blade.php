<x-modal id="modal-update-menu-categories">
    <x-slot name="title"><em class="fa fa-user mr-1"></em> Actualizar categoría</x-slot>

    <x-slot name="content">
        <x-form method="PUT" action="/menu-manager/categories" name="form-update-menu-categories">
            <x-form-input-hidden name="id"></x-form-input-hidden>
            @include('modules.menus.categories.form.create')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendMenuCategoriesUpdate.Send()" text="Actualizar categoría"></x-form-button-to-accept>
    </x-slot>
</x-modal>
