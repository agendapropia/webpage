<header>
	<nav class="navbar navbar-web">
		<div class="navbar__brand">
			<img src="{{ asset('assets') }}/web/icons/ic-agenda.svg" alt="logo-agenda-propia" />
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
				<a href="{{ URL::route('/') }}" style="text-decoration:none">
					Inicio</a>
				</x-web.menu.item>
				<x-web.menu.item>
				<a href="{{ URL::route('historias') }}" style="text-decoration:none">
					Historias</a>
				</x-web.menu.item>
				<x-web.menu.item>
					Mochila de saberes
				</x-web.menu.item>
				<x-web.menu.item>
					Red tejiendo historias
				</x-web.menu.item>
				<x-web.menu.item>
					Oportunidades
				</x-web.menu.item>
				<x-web.menu.item>
					Nosotros
				</x-web.menu.item>
				<x-web.menu.item>
					Contactenos
				</x-web.menu.item>
				<x-web.menu.item>
				<i class="fa-solid fa-magnifying-glass"></i>
				</x-web.menu.item>
			</ul>
		</div>
	</nav>
</header>
	