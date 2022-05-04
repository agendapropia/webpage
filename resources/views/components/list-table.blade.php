<div class="container-fluid mt--6 table-gear">

    <div class="row">
        <div class="col-xl-2 col-md-3 card-filters">
            <div class="card p-3">
                @include('layouts.admin.plugins.tableGear.filter_search')

                @if(isset($filter))
                    <div class="block-filters">
                        <span class="name">{{ __('tablegear.filters') }}</span>
                        {{ isset($filter) ? $filter : null  }}
                    </div>
                @endif

                <div class="paginate-label">
                    <div class="item">
                        @include('layouts.admin.plugins.tableGear.per_page')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-10 col-md-9 card p-0 card-content">
            <div class="card-header border-0">
                <div class="content-heading" style="padding-top:0px">
                    <div class="float-right">
                        {{ isset($menu_top) ? $menu_top : null  }}
                    </div>
                </div>
                <div class="form">
                    @include('layouts.admin.plugins.tableGear.filter_select_item')
                    @include('layouts.admin.plugins.tableGear.filter_update')
                    <div class="btn-group menu-select" role="group" style="display:inline-block;">
                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="exampleGroupDrop2" data-toggle="dropdown" aria-expanded="false">
                            Opciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="exampleGroupDrop1" role="menu">
                            <h7 class="dropdown-header">Seleccionados (<span class="number-selected"></span>)</h7>
                            {{ isset($menu_select) ? $menu_select : null }}
                        </div>
                    </div>
                </div>

                <div class="block-options">
                </div>
            </div>

            @include('layouts.admin.plugins.tableGear.body_table')
            @include('layouts.admin.plugins.tableGear.footer')
            {{ isset($template) ? $template : null }}

            <div class="overlay">
                <div class="content">
                    <i class="fa fa-3x fa-cog fa-spin"></i>
                </div>
            </div>
        </div>
    </div>
</div>
