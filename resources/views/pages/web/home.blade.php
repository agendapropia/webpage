@extends('layouts.web.app')

<x-web.menu.navbar />
@section('content')

    <x-web.carousel.standar />
    <x-web.section.notice />
    @include('layouts.web.home.articles-images')
    @include('layouts.web.home.articles-text')
    @include('layouts.web.home.most-read')
    @include('layouts.web.home.video')
    @include('layouts.web.home.backpack')
    @include('layouts.web.home.weaving-stories')
    @include('layouts.web.home.cocreation')
    @include('layouts.web.home.instagram-recommended')

@endsection
