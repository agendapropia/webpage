<header>
	<nav class="navbar navbar--scrolled">
		<div class="navbar__brand navbar__brand--show">
			<img src="{{ asset('assets') }}/web/icons/ic-color-agenda.svg" alt="logo-agenda-propia" />
		</div>
		<button class="navbar__hamburger">
			<span></span>
			<span></span>
			<span></span>
		</button>
		<div class="navbar__menu">
		<ul>
				<x-web.menu.item>
				<a href="{{ URL::route('/') }}"  class="current" style="text-decoration:none">
					Inicio</a>
				</x-web.menu.item>
				<x-web.menu.item>
				<a href="{{ URL::route('historias') }}" style="text-decoration:none">
					Historias</a>
				</x-web.menu.item>
				<x-web.menu.item>
				<a style="text-decoration:none">
					Mochila de saberes</a>
				</x-web.menu.item>
				<x-web.menu.item>
				<a style="text-decoration:none">
					Red tejiendo historias</a>
				</x-web.menu.item>
				<x-web.menu.item>
				<a style="text-decoration:none">
					Oportunidades</a>
				</x-web.menu.item>
				<x-web.menu.item>
					Nosotros
				</x-web.menu.item>
				<x-web.menu.item>
					Contáctenos
				</x-web.menu.item>
				<x-web.menu.item>
				<i class="fa-solid fa-magnifying-glass"></i>
				</x-web.menu.item>
			</ul>
		</div>
	</nav>
</header>