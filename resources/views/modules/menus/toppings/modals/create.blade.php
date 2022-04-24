<x-modal id="modal-create-menu-toppings">
    <x-slot name="title"><em class="fa fa-user mr-2"></em>Crear Toppings</x-slot>

    <x-slot name="content">
        <x-form method="POST" action="/menu-manager/toppings" name="form-create-menu-toppings">
            @include('modules.menus.toppings.form.create')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendCreateMenuToppings.Send()" text="Crear topping"></x-form-button-to-accept>
    </x-slot>
</x-modal>
