<x-admin.plugins.list-table>
    <x-slot name="title">Usuarios</x-slot>

    <x-slot name="menu_top">
        @can('user-create')
            <button type="button" class="btn btn-sm btn-success" data-modal="#modal-create-user" data-action="CreateUser" onclick="UserTable.Modal(this);">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('modules.users.button_new_user') }}
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
                    @can('user-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-user" data-action="UpdateUser" onclick="UserTable.Modal(this);"">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                    @endCan
                    @can('role-assign')
                        <button class="btn btn-mt btn-ext btn-primary" data-modal="#modal-assign-roles" data-action="AssignRoles" onclick="UserTable.Modal(this);"">
                            <i class="ni ni-lock-circle-open" aria-hidden="true">
                                <label>Permisos</label>
                            </i>
                        </button>
                    @endCan
                    <div class="image-item image-change img-user" data-modal="#modal-utils-imagen-selections" data-action="ActionFilesLoad" onclick="UserTable.Modal(this);">
                        <img src="#_thumbnail_file_#" alt="#_name_#">
                        <div class="image-hover">
                            <div><em class="fa fa-image"></em></div>
                        </div>
                    </div>
                </td>
                <td>
                    <button class="btn-hide" data-modal="#modal-status-user" data-action="ChangeStatusAction" onclick="UserTable.Modal(this);"">
                        <em class="btn-tg fa #_status_#"></em>
                    </button>
                </td>
                <td>
                    #_first_name_# #_last_name_#
                </td>
                <td>#_phone_number_#</td>
                <td>#_email_#</td>
                <td>#_location_#</td>
            </tr>
        </script>
    </x-slot>

</x-admin.plugins.list-table>
