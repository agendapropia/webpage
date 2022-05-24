<x-admin.plugins.list-table>
    <x-slot name="title">Regiones</x-slot>

    <x-slot name="menu_top">
        @can('region-create')
            <button type="button" class="btn btn-sm btn-success" data-modal="#modal-create-main" data-action="ActionMainCreate" onclick="TableMain.Modal(this);">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('modules.specials.button_new') }}
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
                    @can('region-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-main" data-action="ActionMainUpdate" onclick="TableMain.Modal(this);"">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                    @endCan
                </td>
                <td>
                    <span class="badge #_status_label_#">
                        #_status_name_#
                    </span>
                </td>
                <td>
                    #_name_#
                </td>
                <td>
                    #_publication_date_#
                </td>
                <td>
                    #_number_views_#
                </td>
            </tr>
        </script>
    </x-slot>

</x-admin.plugins.list-table>
