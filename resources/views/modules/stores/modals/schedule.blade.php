<x-modal id="modal-schedule-store">
    <x-slot name="title"><em class="fa fa-calendar"></em> Horarios para la tienda "<strong class="name_store"></strong>"</x-slot>

    <x-slot name="content">
        <x-form method="POST" action="/store-manager/stores/{storeId}/schedules" name="form-create-schedule-store">
            @include('modules.stores.modals.form.create-schedule')
        </x-form>

        @include('modules.stores.modals.tables.table-schedule')
    </x-slot>

    <x-slot name="footer">
        <button type="button" class="btn btn-default btn-close" data-dismiss="modal">Cerrar</button>
    </x-slot>
</x-modal>
