@props([
'type' => "",
'country' => "",
'city' => "",
'dark' => false,
])

<div class="badge-location">
	<span class="badge-location__type">{{ $type }}</span>
	<div class="badge-location__country {{
		$dark ? 'badge-location__country--dark' : ''
	}}">
		<i class="fa-solid fa-location-dot"></i>
		<span>{{ $country }} | {{ $city }}</span>
	</div>
</div>