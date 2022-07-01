<div class="table-gear">
    <div class="col-xl-12 col-md-12 pl-0 pr-0">
        <div class="block block-transparent">

            @if(isset($filter_search))
                @include('layouts.admin.plugins.tableGear.filter_search')
            @endif

            @if(isset($filter))
            <div class="block-filters">
                <span class="name">Filtros</span>
                {{ $filter }}
            </div>
            @endif

            <div class="form">
                @if(isset($filter_select_item))
                    @include('layouts.admin.plugins.tableGear.filter_select_item')
                @endif

                @if(isset($filter_update))
                    @include('layouts.admin.plugins.tableGear.filter_update')
                @endif

                @if(isset($filter_select_item))
                <div class="btn-group menu-select" role="group" style="display:inline-block;">
                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="exampleGroupDrop2" data-toggle="dropdown" aria-expanded="false">
                        Opciones
                    </button>
                    <div class="dropdown-menu" aria-labelledby="exampleGroupDrop1" role="menu">
                        <h7 class="dropdown-header">Seleccionados (<span class="number-selected"></span>)</h7>
                        {{ isset($menu_select) ? $menu_select : null }}
                    </div>
                </div>
                @endif
            </div>

            @include('layouts.admin.plugins.tableGear.body_table')

            @if(isset($filter_pagginate))
                @include('layouts.admin.plugins.tableGear.footer')
            @endif

            {{ isset($template) ? $template : null }}

            <x-admin.plugins.overlay></x-admin.plugins.overlay>
        </div>
    </div>
</div>