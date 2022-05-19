<div id="table-special-users">
    <x-admin.plugins.list-table-min>
        <x-slot name="template">
            <script class="template-list" type="text/x-custom-template">
                <tr data-url="panel" data-toggle="">
                    <td>
                        <button class="btn btn-danger btn-mt" onclick="ButtonModalDeleteUsers(this);"">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td>#_user_first_name_# #_user_last_name_#</td>
                    <td>#_role_name_#</td>
                </tr>
            </script>
        </x-slot>
    </x-admin.plugins.list-table-min>
</div>
