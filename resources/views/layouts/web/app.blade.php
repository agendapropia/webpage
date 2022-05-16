<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('Agenda propia', 'Agenda propia') }} | @yield('page_title', 'Bienvenido')</title>
	@include('layouts.web.blocks.css')
</head>

<body>
	<x-web.social-media />
	<main>
		@yield('content')
	</main>
	@include('layouts.web.blocks.js')
</body>
<x-web.footer />

</html>