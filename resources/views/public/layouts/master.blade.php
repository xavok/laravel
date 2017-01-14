<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{ @$content['meta_description'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quansis</title>
    @include('public.includes.head')
    @section('head_close')
    @show


</head>
<body>
@section('body_open')
@show

@include('public.includes.nav')

@section('content')
@show

@include('public.includes.footer')

@include('public.includes.js')
@section('body_close')
@show

</body>
</html>
