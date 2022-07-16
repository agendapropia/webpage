@can('special-module')
    <li class="nav-item">
        <a class="nav-link @yield('menu_specials', '')" href="#navbar-specials" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-specials">
            <i class="fa fa-file-text text-primary"></i>
            <span class="nav-link-text">{{ __('menu.publications') }}</span>
        </a>
        <div class="collapse @yield('menu_specials_collapse', '')" id="navbar-specials">
            <ul class="nav nav-sm flex-column">
                @can('special-module')
                    <li class="nav-item">
                        <a class="nav-link @yield('menu_specials_item', '')" href="{{ route('module-special') }}">
                            {{ __('menu.specials') }}
                        </a>
                    </li>
                @endcan
                @can('special-module')
                    <li class="nav-item">
                        <a class="nav-link @yield('menu_articles_item', '')" href="{{ route('module-article') }}">
                            {{ __('menu.articles') }}
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </li>
@endcan