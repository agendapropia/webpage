<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="@yield('navbar_url', '#')">
            @yield('navbar_title_icon', '')
            @yield('navbar_title', 'Agenda Propia')
        </a>
        
        <!-- Form -->
        <!-- <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
            <div class="form-group mb-0">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('menu.menu-search') }}" type="text">
                </div>
            </div>
        </form> -->

        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="" src="{{ auth()->user()->getUserImage(auth()->user()) }}">
                        </span>
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->first_name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    @include('layouts.admin.navbars.blocks.menu-user')
                </div>
            </li>
        </ul>
    </div>
</nav>