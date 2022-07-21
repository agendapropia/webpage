<div id="table-special-alliedmedia">
    <x-admin.plugins.list-table-min offOverlay>
        <x-slot name="template">
            <script class="template-list" type="text/x-custom-template">
                <tr data-url="panel" data-toggle="">
                    <td>
                        <button class="btn btn-danger btn-mt" onclick="ButtonModalDeleteAlliedMedia(this);"">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                        <div class="image-item">
                            <img src="#_thumbnail_file_#" alt="#_name_#">
                            <div class="image-hover">
                                <div><em class="fa fa-image"></em></div>
                            </div>
                        </div>
                    </td>
                    <td>#_allied_media_name_#
                    <td>#_role_name_#</td>
                </tr>
            </script>
        </x-slot>
    </x-admin.plugins.list-table-min>
</div>
