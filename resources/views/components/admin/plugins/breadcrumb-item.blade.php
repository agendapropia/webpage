<li class="breadcrumb-item" {{ $attributes->merge(['class' => '']) }}>
    <a href="{{ isset($href) ? $href : '' }}">{{ $slot }}</a>
</li>