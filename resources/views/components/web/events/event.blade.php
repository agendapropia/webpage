@props([
'open' => false,
])

<div class="wrapper-events-announ">
	<div class="container-image">
		<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTi40hso7SpsaKIHQf_ojMUGCmsKDutjhXnzS6v7oVuCCOTLZDZtZZt-shyCIKWNtBZepA&usqp=CAU"
			alt="" />
	</div>
	<div class="container-text">
		<div class="text__badge {{$open ? 'text__badge--open' : 'text__badge--close'}}">
			<h3>convocatoria</h3>
			<span>{{
				$open ? 'abierta' : 'cerrada'
			}}</span>
		</div>
		<p>Buscamos editor (a) de apoyo para el proyecto de niñez indígena en Latinoamérica</p>
		<span>Se reciben hojas de vida hasta el <b>22 marzo 2022</b></span>
		<div class="view-more">
			<button {{ $attributes->merge([
				'disabled' => !$open,
			]) }}>
				Ver más
				<i class="fa-solid fa-arrow-right"></i>
			</button>
		</div>
	</div>
	<hr />
</div>