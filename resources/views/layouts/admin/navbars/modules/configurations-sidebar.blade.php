@can('configuration-module')
    <li class="nav-item ">
        <a class="nav-link @yield('menu_configurations', '')" href="#navbar-configurations" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-configurations">
            <i class="fa fa-gear text-primary"></i>
            <span class="nav-link-text">{{ __('menu.configurations') }}</span>
        </a>
        <div class="collapse @yield('menu_configurations_collapse', '')" id="navbar-configurations">
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
                @can('alliedmedia-module')
                    <li class="nav-item">
                        <a class="nav-link @yield('menu_configurations_alliedmedia', '')" href="{{ route('module-alliedmedia') }}">
                            {{ __('menu.configurations-alliedmedia') }}
                        </a>
                    </li>
                @endcan
                @can('files-module')
                    <li class="nav-item">
                        <a class="nav-link @yield('menu_configurations_files', '')" href="{{ route('module-tags') }}">
                            {{ __('menu.configurations-files') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </li>
@endcan