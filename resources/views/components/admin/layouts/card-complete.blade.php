<div class="col-md-12 card p-3 mt-1 {{ isset($divClass) ? $divClass : '' }}">
    <div class="card-body border-0 p-0"> 
       {{ $slot }}
    </div>
    @if (isset($overlayTransparent))
        <x-admin.plugins.overlay divClass="overlay-div-transparent"></x-admin.plugins.overlay>
    @else
        <x-admin.plugins.overlay></x-admin.plugins.overlay>
    @endif
</div>