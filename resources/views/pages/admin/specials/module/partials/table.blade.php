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

    <x-slot name="filter">
        <select class="form-control filter filter_status_id mt-1">
            <option value="">Estados</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>
    </x-slot>

    <x-slot name="template">
        <script class="template-list" type="text/x-custom-template">
            <tr data-url="panel" data-toggle="">
                <td>
                    <input type="checkbox" name="select_item" class="chkbox checkbox-icheck" id="id_chk#key#">
                    @can('special-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-main" data-action="ActionMainUpdate" onclick="TableMain.Modal(this);" title="Editar">
                            <i class="fa fa-cog" aria-hidden="true" title="Editar">
                            </i>
                        </button>
                        <button class="btn btn-mt btn-ext btn-primary" data-modal="#modal-utils-imagen-selections" data-action="ActionFilesLoad" onclick="TableMain.Modal(this);" title="Imágenes">
                            <i class="fa fa-image" aria-hidden="true" title="Imágenes">
                                <label>Imágenes</label>
                            </i> 
                        </button>
                        <button class="btn btn-mt btn-ext btn-primary" data-modal="#modal-special-users" data-action="ActionModalUsers" onclick="TableMain.Modal(this);" title="Usuarios">
                            <i class="fa fa-user" aria-hidden="true">
                                <label>Usuarios</label>
                            </i>
                        </button>
                        <button class="btn btn-mt btn-ext btn-primary" data-modal="#modal-special-alliedmedia" data-action="ActionModalAlliedMedia" onclick="TableMain.Modal(this);" title="Medios aliados">
                            <i class="fa fa-address-book" aria-hidden="true">
                                <label>Medios</label>
                            </i>
                        </button>
                        <a class="btn btn-mt btn-ext btn-mt-primary" href="/admin/specials/#_slug_#/contents" title="Contenidos">
                            <i class="fa fa-file-text" aria-hidden="true">
                                <label>Contenido</label>
                            </i>
                        </a>
                        <a class="btn btn-mt btn-ext btn-mt-info" href="/admin/articles?special_id=#_id_#" title="Artículos">
                            <i class="fa fa-list-alt" aria-hidden="true">
                                <label>Ver artículos</label>
                            </i>
                        </a>
                    @endCan
                </td>
                <td>
                    <span class="badge #_status_label_# btn-cursor" data-modal="#modal-status-main" data-action="ActionModalStatus" onclick="TableMain.Modal(this);">
                        #_status_name_#
                    </span>
                </td>
                <td>
                    #_name_#
                </td>
                <td>
                    <em class="fa fa-pencil-square btn-inline-block" data-modal="#modal-url-main" data-action="ActionModalUrl" onclick="TableMain.Modal(this);"></em>
                    <a href="/specials/#_slug_#" target="_blank">/#_slug_#</a>
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
