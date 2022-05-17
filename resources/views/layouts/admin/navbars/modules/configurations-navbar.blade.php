@can('configuration-module')
    <li class="nav-item ">
        <a class="nav-link @yield('menu_configurations', '')" href="#navbar-account" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-account">
            <i class="fa fa-gear text-primary"></i>
            <span class="nav-link-text">{{ __('menu.configurations') }}</span>
        </a>
        <div class="collapse @yield('menu_configurations_collapse', '')" id="navbar-account">
            <ul class="nav nav-sm flex-column">
                @can('region-module')
                    <li class="nav-item">
                        <a class="nav-link @yield('menu_configurations_regions', '')" href="{{ route('module-regions') }}">
                            {{ __('menu.configurations-regions') }}
                        </a>
                    </li>
                @endcan
                @can('tag-module')
                    <li class="nav-item">
                        <a class="nav-link @yield('menu_configurations_tags', '')" href="{{ route('module-tags') }}">
                            {{ __('menu.configurations-tags') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </li>
@endcan