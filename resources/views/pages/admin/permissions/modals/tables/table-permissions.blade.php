<div id="assign-permissions">
    <x-admin.plugins.list-table-min>
        <x-slot name="template">
            <script class="template-list" type="text/x-custom-template">
                <tr data-url="panel" data-toggle="">
                    <td>
                        <input type="checkbox" name="select_item" class="chkbox checkbox-icheck" id="#key#">
                    </td>
                    <td>#_name_#</td>
                    <td>#_description_#</td>
                    <td>#_name_module_#</td>
                </tr>
            </script>
        </x-slot>
    </x-admin.plugins.list-table-min>
</div>
