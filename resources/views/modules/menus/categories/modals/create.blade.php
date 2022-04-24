<x-modal id="modal-create-menu-categories">
    <x-slot name="title"><em class="fa fa-user mr-2"></em>Nueva categoría</x-slot>

    <x-slot name="content">
        <x-form method="POST" action="/menu-manager/categories" name="form-create-menu-categories">
            @include('modules.menus.categories.form.create')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendCreateMenuCategories.Send()" text="Crear categoría"></x-form-button-to-accept>
    </x-slot>
</x-modal>
