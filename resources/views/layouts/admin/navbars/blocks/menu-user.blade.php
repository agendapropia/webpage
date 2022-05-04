<div class=" dropdown-header noti-title">
    <h6 class="text-overflow m-0">{{ __('menu.menu-user-welcome') }}</h6>
</div>
<a href="" class="dropdown-item">
    <em class="ni ni-single-02"></em>
    <span>{{ __('menu.menu-user-profile') }}</span>
</a>
<div class="dropdown-item button-modal-change-of-password">
    <em class="fa fa-key"></em>
    <span>{{ __('menu.menu-user-change-password') }}</span>
</div>
<div class="dropdown-divider"></div>
<a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
    <em class="ni ni-user-run"></em>
    <span>{{ __('menu.menu-user-sign-off') }}</span>
</a>