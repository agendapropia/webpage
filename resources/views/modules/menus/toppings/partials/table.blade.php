<x-list-table>
    <x-slot name="title">Toppings</x-slot>

    <x-slot name="menu_top">
        @can('menu-topping-create')
            <button type="button" class="btn btn-sm btn-success" data-modal="#modal-create-menu-toppings" data-action="CreateMenuToppings" onclick="MenuToppingTable.Modal(this);">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('modules.users.button_new_user') }}
            </button>
        @endcan
    </x-slot>

    <x-slot name="menu_select">
        <!-- <a class="dropdown-item" href="javascript:void(0)" data-modal="#modalCreateUser" data-action="createUserModal" onclick="userTable.Modal(this);">
            <i class="fa fa-fw fa-check-square-o mr-5"></i>
        </a> -->
    </x-slot>

    <x-slot name="filter">
        <select class="form-control filter filter_status">
            <option value="">Estados</option>
            <option value="1">Activos</option>
            <option value="0"">Inactivos</option>
        </select>
    </x-slot>

    <x-slot name="template">
        <script class="template-list" type="text/x-custom-template">
            <tr data-url="panel" data-toggle="">
                <td>
                    <input type="checkbox" name="select_item" class="chkbox checkbox-icheck" id="id_chk#key#">
                    @can('menu-topping-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-menu-toppings" data-action="UpdateMenuTopping" onclick="MenuToppingTable.Modal(this);"">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                    @endCan
                    <img class="image-item" src="#_image_#" alt="#_name_#">
                </td>
                <td>
                    <button class="btn-hide" data-modal="#modal-status-menu-topping" data-action="ChangeStatusAction" onclick="MenuToppingTable.Modal(this);"">
                        <i class="btn-tg fa #_status_#"></i>
                    </button>
                </td>
                <td>
                    #_name_#
                </td>
                <td>
                    #_description_#...
                </td>
                <td>#_name_store_#</td>
            </tr>
        </script>
    </x-slot>

</x-list-table>
