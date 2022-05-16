<x-admin.plugins.list-table>
    <x-slot name="title">Permisos</x-slot>

    <x-slot name="menu_top">
        @can('role-create')
            <button type="button" class="btn btn-sm btn-success" data-modal="#modal-create-permissions" data-action="CreatePermissions" onclick="permissionTable.Modal(this);">
                <em class="fa fa-plus" aria-hidden="true"></em> {{ __('modules.permissions.button_new_permission') }}
            </button>
        @endcan
    </x-slot>

    <x-slot name="menu_select">
    </x-slot>

    <x-slot name="filter">
        <select class="form-control filter filter_modules">
            <option value="">Modulos</option>
            @foreach ($modules as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </x-slot>

    <x-slot name="template">
        <script class="template-list" type="text/x-custom-template">
            <tr data-url="panel" data-toggle="">
                <td>
                    <input type="checkbox" name="select_item" class="chkbox checkbox-icheck" id="id_chk#key#">
                    @can('role-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-permissions" data-action="UpdatePermissions" onclick="permissionTable.Modal(this);"">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                    @endcan
                </td>
                <td>#_name_#</td>
                <td>#_description_#</td>
                <td>#_name_module_#</td>
                <td>#_guard_name_#</td>
            </tr>
        </script>
    </x-slot>

</x-admin.plugins.list-table>
