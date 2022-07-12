@extends('layouts.web.app')

<x-web.menu.navbar />

@section('content')
    <x-web.section.int-art-img-sup />
    @include('layouts.web.internal-article.team')
    @include('layouts.web.internal-article.traductor')
    @include('layouts.web.internal-article.content-header')
    @include('layouts.web.internal-article.content')
    @include('layouts.web.internal-article.video')
    @include('layouts.web.internal-article.content')
    @include('layouts.web.internal-article.title')
    @include('layouts.web.internal-article.content-citas')
    <x-web.section.int-art-img-sup />
    @include('layouts.web.internal-article.content')
    <x-web.section.int-art-soundcloud />
    @include('layouts.web.internal-article.content')
    @include('layouts.web.internal-article.video-loop')
    @include('layouts.web.internal-article.content')
    <x-web.carousel.carousel-int-art />
    @include('layouts.web.internal-article.content')
    @include('layouts.web.internal-article.title')
    @include('layouts.web.internal-article.content-img-doble')
    @include('layouts.web.internal-article.title')
    <x-web.section.int-art-galery />
    @include('layouts.web.internal-article.content')
    <x-web.section.int-art-map />
    @include('layouts.web.internal-article.content')
    <x-web.section.int-art-pdf />
    @include('layouts.web.related')
    @include('layouts.web.most-read')

@endsection