<li class="nav-item">
    <a class="nav-link @yield('menu_menu', '')" href="#navbar-menu" data-toggle="collapse" role="button" aria-expanded="false">
        <i class="fa fa-cutlery text-primary"></i>
        <span class="nav-link-text">{{ __('menu.menu') }}</span>
    </a>
    <div class="collapse @yield('menu_menu_collapse', '')" id="navbar-menu">
        <ul class="nav nav-sm flex-column">
            @can('role-module')
            <li class="nav-item">
                <a class="nav-link @yield('menu_menu_roles', '')" href="{{ route('module-roles') }}">
                    {{ __('menu.menu-menus') }}
                </a>
            </li>
            @endcan
            @can('role-module')
            <li class="nav-item">
                <a class="nav-link @yield('menu_menu_users', '')" href="{{ route('module-users') }}">
                    {{ __('menu.menu-products') }}
                </a>
            </li>
            @endcan
            @can('menu-topping-module')
            <li class="nav-item">
                <a class="nav-link @yield('menu_menu_toppings', '')" href="{{ route('route-menu-toppings') }}">
                    {{ __('menu.menu-toppings') }}
                </a>
            </li>
            @endcan
            @can('permission-module')
            <li class="nav-item ">
                <a class="nav-link @yield('menu_menu_config', '')" href="#navbar-menu-config" data-toggle="collapse" role="button" aria-expanded="false">
                    <span class="nav-link-text">{{ __('menu.menu-config') }}</span>
                </a>
                <div class="collapse @yield('menu_menu_config_collapse', '')" id="navbar-menu-config">
                    <ul class="nav nav-sm flex-column">
                        @can('role-module')
                        <li class="nav-item">
                            <a class="nav-link @yield('menu_menu_categories', '')" href="{{ route('route-menu-categories') }}">
                                {{ __('menu.menu-categories') }}
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endcan
        </ul>
    </div>
</li>