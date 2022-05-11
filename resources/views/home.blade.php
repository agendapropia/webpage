@extends('layouts.web.app')

@section('content')

<x-web.carousel.standar />
<x-web.section.notice />

@include('layouts.web.layouts.home.articles-images')
@include('layouts.web.layouts.home.articles-text')
@include('layouts.web.layouts.home.most-read')
@include('layouts.web.layouts.home.video')

@endsection
