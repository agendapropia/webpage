@extends('layouts.web.app')

<x-web.menu.navbar />

@section('content')
    <x-web.section.home-co-front-page />
    @include('layouts.web.cocreation-internal.team')
    @include('layouts.web.cocreation-internal.traductor')
    @include('layouts.web.cocreation-internal.content-header')
    @include('layouts.web.cocreation-internal.content')
    @include('layouts.web.cocreation-internal.video')
    @include('layouts.web.cocreation-internal.content')
    @include('layouts.web.cocreation-internal.title')
    @include('layouts.web.cocreation-internal.content-citas')
    <x-web.section.int-art-img-sup />
    @include('layouts.web.cocreation-internal.content')
    <x-web.section.int-art-soundcloud />
    @include('layouts.web.cocreation-internal.content-img')
    @include('layouts.web.cocreation-internal.content')
    @include('layouts.web.cocreation-internal.video-loop')
    @include('layouts.web.cocreation-internal.content')
    <x-web.carousel.carousel-int-art />
    @include('layouts.web.cocreation-internal.content')
    @include('layouts.web.cocreation-internal.title')
    @include('layouts.web.cocreation-internal.content-img-doble')
    @include('layouts.web.cocreation-internal.title')
    <x-web.section.int-art-galery />
    @include('layouts.web.cocreation-internal.content')
    <x-web.section.int-art-map />
    @include('layouts.web.cocreation-internal.content')
    <x-web.section.int-art-pdf />
    @include('layouts.web.related')
    @include('layouts.web.credits')

@endsection
