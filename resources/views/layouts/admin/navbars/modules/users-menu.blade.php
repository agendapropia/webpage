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