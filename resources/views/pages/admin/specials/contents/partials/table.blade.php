<x-admin.plugins.list-table>
    <x-slot name="title">Regiones</x-slot>

    <x-slot name="menu_top">
        @can('alliedmedia-create')
            <button type="button" class="btn btn-sm btn-success" data-modal="#modal-create-main" data-action="ActionMainCreate" onclick="TableMain.Modal(this);">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('modules.alliedmedia.button_new') }}
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
                    @can('alliedmedia-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-main" data-action="ActionMainUpdate" onclick="TableMain.Modal(this);" title="Editar">
                            <i class="fa fa-cog" aria-hidden="true" title="Editar"></i>
                        </button>
                    @endCan
                    <div class="image-item image-change" data-modal="#modal-utils-imagen-selections" data-action="ActionFilesLoad" onclick="TableMain.Modal(this);">
                        <img src="#_thumbnail_file_#" alt="#_name_#">
                        <div class="image-hover">
                            <div><em class="fa fa-image"></em></div>
                        </div>
                    </div>
                </td>
                <td>
                    #_name_#
                </td>
                <td>
                    <a href="/specials/#_url_#" target="_blank">#_url_#</a>
                </td>
            </tr>
        </script>
    </x-slot>

</x-admin.plugins.list-table>
