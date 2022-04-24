<x-list-table>
    <x-slot name="title">Toppings</x-slot>

    <x-slot name="menu_top">
        @can('menu-categorie-create')
            <button type="button" class="btn btn-sm btn-success" data-modal="#modal-create-menu-categories" data-action="CreateMenuCategories" onclick="MenuCategoriesTable.Modal(this);">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('modules.menu_categorie.button_new') }}
            </button>
        @endcan
    </x-slot>

    <x-slot name="menu_select">
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
                    @can('menu-categorie-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-menu-categories" data-action="UpdateMenuCategories" onclick="MenuCategoriesTable.Modal(this);"">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                    @endCan
                </td>
                <td>
                    <button class="btn-hide" data-modal="#modal-status-menu-categories" data-action="ChangeStatusAction" onclick="MenuCategoriesTable.Modal(this);"">
                        <i class="btn-tg fa #_status_#"></i>
                    </button>
                </td>
                <td>#_name_#</td>
                <td>#_category_name_#</td>
                <td>#_store_name_#</td>
            </tr>
        </script>
    </x-slot>

</x-list-table>
