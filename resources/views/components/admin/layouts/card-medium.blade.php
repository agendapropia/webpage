<div class="col-md-8 card p-3 mt-1 {{ isset($divClass) ? $divClass : '' }}">
    <div class="card-body border-0 p-0"> 
       {{ $slot }}
    </div>
    <x-admin.plugins.overlay></x-admin.plugins.overlay>
</div>