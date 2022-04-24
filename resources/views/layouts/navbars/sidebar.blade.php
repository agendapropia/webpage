<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    @include('layouts.navbars.blocks.menu-user')
                </div>
            </li>
        </ul>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('menu.menu-search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('dashboard.main') }}
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Configuraciones</h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                @can('user-module')
                <li class="nav-item ">
                    <a class="nav-link @yield('menu_account', '')" href="#navbar-account" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-account">
                        <i class="fa fa-user text-primary"></i>
                        <span class="nav-link-text">{{ __('menu.accounts') }}</span>
                    </a>
                    <div class="collapse @yield('menu_account_collapse', '')" id="navbar-account">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link @yield('menu_account_users', '')" href="{{ route('module-users') }}">
                                    {{ __('menu.accounts-users') }}
                                </a>
                            </li>
                            @can('role-module')
                            <li class="nav-item">
                                <a class="nav-link @yield('menu_account_roles', '')" href="{{ route('module-roles') }}">
                                    {{ __('menu.accounts-roles') }}
                                </a>
                            </li>
                            @endcan
                            @can('permission-module')
                            <li class="nav-item">
                                <a class="nav-link @yield('menu_account_permissions', '')" href="{{ route('module-permissions') }}">
                                    {{ __('menu.accounts-permissions') }}
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcan

                @can('store-module')
                <li class="nav-item ">
                    <a class="nav-link @yield('menu_store_manager', '')" href="#navbar-stores" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-stores">
                        <i class="fa fa-building text-primary"></i>
                        <span class="nav-link-text">{{ __('menu.stores-manager') }}</span>
                    </a>
                    <div class="collapse @yield('menu_store_manager_collapse', '')" id="navbar-stores">
                        <ul class="nav nav-sm flex-column">
                            @can('store-module')
                            <li class="nav-item">
                                <a class="nav-link @yield('menu_store_manager_stores', '')" href="{{ route('route-stores') }}">
                                    {{ __('menu.stores-stores') }}
                                </a>
                            </li>
                            @endcan
                        </ul>

                    </div>
                </li>
                @endcan

                @include('layouts.navbars.modules.menus')
               
            </ul>

        </div>
    </div>
</nav>