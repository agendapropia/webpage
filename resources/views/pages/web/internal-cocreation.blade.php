@extends('layouts.web.app')

<x-web.menu.navbar />

@section('content')
    <x-web.section.cocreation-front-page />
    <x-web.menu.menu-cocreation />
    @include('layouts.web.internal-cocreation.team')
    @include('layouts.web.internal-cocreation.traductor')
    @include('layouts.web.internal-cocreation.content-header')
    @include('layouts.web.internal-cocreation.content')
    @include('layouts.web.internal-cocreation.video')
    @include('layouts.web.internal-cocreation.content')
    @include('layouts.web.internal-cocreation.title')
    @include('layouts.web.internal-cocreation.content-citas')
    <x-web.section.int-art-img-sup />
    @include('layouts.web.internal-cocreation.content')
    <x-web.section.int-art-soundcloud />
    @include('layouts.web.internal-cocreation.content')
    @include('layouts.web.internal-cocreation.content-img')
    @include('layouts.web.internal-cocreation.video-loop')
    @include('layouts.web.internal-cocreation.content')
    @include('layouts.web.internal-cocreation.carousel')
    @include('layouts.web.internal-cocreation.content')
    @include('layouts.web.internal-cocreation.title')
    @include('layouts.web.internal-cocreation.content-img-doble')
    @include('layouts.web.internal-cocreation.title')
    <x-web.section.int-art-galery />
    @include('layouts.web.internal-cocreation.content')
    <x-web.section.int-art-map />
    @include('layouts.web.internal-cocreation.content')
    <x-web.section.int-art-pdf />
    <x-web.share />
    <x-web.comment />
    @include('layouts.web.related')
    @include('layouts.web.allied-media')
    @include('layouts.web.credits')

    
@endsection