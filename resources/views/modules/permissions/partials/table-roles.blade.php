<x-list-table>
    <x-slot name="title">Roles</x-slot>

    <x-slot name="menu_top">
        @can('role-create')
            <button type="button" class="btn btn-sm btn-success" data-modal="#modal-create-roles" data-action="CreateRole" onclick="roleTable.Modal(this);">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('modules.roles.button_new_role') }}
            </button>
        @endcan
    </x-slot>

    <x-slot name="menu_select">
    </x-slot>

    <x-slot name="template">
        <script class="template-list" type="text/x-custom-template">
            <tr data-url="panel" data-toggle="">
                <td>
                    <input type="checkbox" name="select_item" class="chkbox checkbox-icheck" id="id_chk#key#">
                    @can('role-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-roles" data-action="UpdateRoles" onclick="roleTable.Modal(this);"">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                    @endcan
                    @can('permission-assign')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-assign-permissions" data-action="AssignPermissions" onclick="roleTable.Modal(this);"">
                            <i class="fa fa-flag" aria-hidden="true"></i>
                        </button>
                    @endcan
                </td>
                <td>#_name_#</td>
                <td>#_description_#</td>
                <td>#_guard_name_#</td>
            </tr>
        </script>
    </x-slot>

</x-list-table>
