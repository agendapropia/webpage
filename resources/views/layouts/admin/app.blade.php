<!DOCTYPE html>
@auth()
    <html lang="{{ auth()->user()->location }}">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endauth    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Agenda Propia') }} | @yield('page_title', 'Bienvenido')</title>
        @include('layouts.admin.blocks.css')
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.admin.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('layouts.admin.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.admin.footers.guest')
        @endguest

        <!-- modal transversal -->
        @include('layouts.admin.utils.change-of-password')

        @include('layouts.admin.blocks.js')
    </body>
</html>