<x-modal id="modal-update-menu-toppings">
    <x-slot name="title"><em class="fa fa-user mr-1"></em> Actualizar Toppings</x-slot>

    <x-slot name="content">
        <x-form method="PUT" action="/menu-manager/toppings" name="form-update-menu-toppings">
            <x-form-input-hidden name="id"></x-form-input-hidden>
            @include('modules.menus.toppings.form.create')
        </x-form>
    </x-slot>

    <x-slot name="footer">
        <x-form-button-cancel text="Cerrar"></x-form-button-accept>
        <x-form-button-to-accept action="SendMenuToppingUpdate.Send()" text="Actualizar topping"></x-form-button-to-accept>
    </x-slot>
</x-modal>
