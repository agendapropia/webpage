<x-list-table>
    <x-slot name="menu_top">
        @can('store-create')
            <button type="button" class="btn btn-sm btn-success" data-modal="#modal-create-store" data-action="CreateStore" onclick="StoreTable.Modal(this);">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('modules.stores.button_new_store') }}
            </button>
        @endcan
    </x-slot>

    <x-slot name="menu_select">
        <!-- <a class="dropdown-item" href="javascript:void(0)" data-modal="#modalCreateStore" data-action="createStoreModal" onclick="storeTable.Modal(this);">
            <i class="fa fa-fw fa-check-square-o mr-5"></i>
        </a> -->
    </x-slot>

    <x-slot name="filter">
        <select class="form-control filter filter_status">
            <option value="">{{ __('modules.stores.filter_status') }}</option>
            <option value="1">Activos</option>
            <option value="2">Inactivos</option>
            <option value="3">Cierre termporal</option>
        </select>

        <select class="form-control filter filter_store_types select_filter">
            <option value="">{{ __('modules.stores.filter_store_type') }}</option>
            @foreach ($store_types as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>


    </x-slot>

    <x-slot name="template">
        <script class="template-list" type="text/x-custom-template">
            <tr data-url="panel" data-toggle="">
                <td>
                    <input type="checkbox" name="select_item" class="chkbox checkbox-icheck" id="id_chk#key#">
                    @can('store-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-store" data-action="UpdateStore" onclick="StoreTable.Modal(this);"">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                    @endCan
                    @can('store-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-schedule-store" data-action="ScheduleStore" onclick="StoreTable.Modal(this);"">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                        </button>
                    @endCan
                </td>
                <td>
                    <button class="btn-hide" data-modal="#modal-status-store" data-action="ChangeStatusAction" onclick="StoreTable.Modal(this);"">
                        <i class="btn-tg fa #_status_#"></i>
                    </button>
                </td>
                <td>
                    #_name_short_#
                </td>
                <td>#_phone_code_##_phone_number_#</td>
                <td>#_store_type_#</td>
            </tr>
        </script>
    </x-slot>

</x-list-table>
