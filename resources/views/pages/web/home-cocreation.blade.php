@extends('layouts.web.app')

<x-web.menu.navbar />

@section('content')

    <x-web.section.home-co-front-page />
    <x-web.section.home-co-share />
    @include('layouts.web.home-cocreation.traductor')
    @include('layouts.web.home-cocreation.header')
    @include('layouts.web.home-cocreation.img')
    @include('layouts.web.home-cocreation.title')
    @include('layouts.web.home-cocreation.gallery')
    @include('layouts.web.home-cocreation.content')
    @include('layouts.web.home-cocreation.content-citas')
    @include('layouts.web.home-cocreation.section')
    @include('layouts.web.home-cocreation.content')
    @include('layouts.web.home-cocreation.content-color')
    @include('layouts.web.home-cocreation.share')
    <x-web.serie />
    @include('layouts.web.credits')
    @include('layouts.web.allied-media')
   

@endsection