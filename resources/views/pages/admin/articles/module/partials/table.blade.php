<x-admin.plugins.list-table>
    <x-slot name="title"></x-slot>

    <x-slot name="menu_top">
        @can('articles-create')
            <button type="button" class="btn btn-sm btn-success" data-modal="#modal-create-main" data-action="ActionMainCreate" onclick="TableMain.Modal(this);">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ __('modules.articles.button_new') }}
            </button>
        @endcan
    </x-slot>

    <x-slot name="menu_select">
    </x-slot>

    <x-slot name="filter">
        <select class="form-control filter filter_special_id">
            <option value="">Especiales</option>
            @foreach ($specials as $special)
                <option value="{{ $special->id }}">{{ $special->name }}</option>
            @endforeach
        </select>

        <select class="form-control filter filter_status_id mt-1">
            <option value="">Estados</option>
            @foreach ($status as $statu)
                <option value="{{ $statu->id }}">{{ $statu->name }}</option>
            @endforeach
        </select>
    </x-slot>

    <x-slot name="template">
        <script class="template-list" type="text/x-custom-template">
            <tr data-url="panel" data-toggle="">
                <td>
                    <input type="checkbox" name="select_item" class="chkbox checkbox-icheck" id="id_chk#key#">
                    @can('article-update')
                        <button class="btn btn-mt btn-primary" data-modal="#modal-update-main" data-action="ActionMainUpdate" onclick="TableMain.Modal(this);" title="Editar">
                            <i class="fa fa-cog" aria-hidden="true" title="Editar"></i>
                        </button>
                        <button class="btn btn-mt btn-primary" data-modal="#modal-utils-imagen-selections" data-action="ActionFilesLoad" onclick="TableMain.Modal(this);" title="Imágenes">
                            <i class="fa fa-image" aria-hidden="true" title="Imágenes"></i> 
                        </button>
                        <button class="btn btn-mt btn-primary" data-modal="#modal-article-users" data-action="ActionModalUsers" onclick="TableMain.Modal(this);" title="Usuarios">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </button>
                        <a class="btn btn-mt btn-mt-primary" href="/admin/articles/#_slug_#/contents" title="Contenidos">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                        </a>
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
                    #_article_type_name_#
                </td>
                <td>
                    <a href="/articles/#_slug_#" target="_blank">/#_slug_#</a>
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
