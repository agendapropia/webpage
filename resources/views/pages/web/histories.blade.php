@extends('layouts.web.app')

<x-web.menu.fixed-menu />
@section('content')
@include('layouts.web.histories.intro')
@include('layouts.web.histories.report')
@include('layouts.web.histories.hs-cocreation')
@include('layouts.web.histories.cocreation')
<x-web.section.hs-cocreation />
@endsection
