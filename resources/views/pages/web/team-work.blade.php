@extends('layouts.web.app')

<x-web.menu.fixed-menu />

@section('content')
    @include('layouts.web.team-work.title')
    @include('layouts.web.team-work.team')
@endsection