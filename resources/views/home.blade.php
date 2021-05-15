@extends('layouts.default')

@section('content')

<div class="mx-auto max-w-2xl mt-20 px-5 md:px-0">
    <div class="prose prose-xl">
        <h1 class="font-xl font-bold leading-tight">Heya, I'm Stef 👋🏻</h1>
        <p>Online known as <a href="https://twitter.com/hyra">@hyra</a>, I'm an entrepeneur, web-developer, tooling enthusiast, martial artist and experienced procrastinator from Amsterdam.</p>
        <p>I enjoy building useful and useless applications in <a href="https://nodejs.org/en/">Node</a>, <a href="https://vuejs.org/">VueJS</a>, <a href="https://laravel.com/docs/8.x">Laravel</a> or bash. Recently picked up <a href="https://golang.org/">Golang</a> as well.<p>
        <p>During the day I work as CTO at <a href="https://noprotocol.nl">NoProtocol</a> where we build complete solutions for ambitious clients.</p>
        <p>On this blog I write about my findings, struggles and solutions I encounter during my development experiences. Both during developing and managing the process in a team.</p>
    </div>
    {{-- <div class="mt-16 border-b border-gray-800"></div> --}}
</div>

<br>
<br>
<br>

@stop

@section('og')
    <meta name="description" content="I'm Stef van den Ham (@hyra), entrepeneur, web-developer, tooling enthusiast, martial artist and experienced procrastinator from Amsterdam. Writing about all things web.">
    <meta property="og:title" content="Mindthecode">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Writing about all things web.">
    <meta property="og:url" content="https://mindthecode.com">
    <meta property="og:site_name" content="Mindthecode">
    <meta property="og:image" content="https://mindthecode.com/fb_share.jpg">
    <meta property="twitter:description" content="Writing about all things web.">
    <meta property="twitter:title" content="Mindthecode">
@stop
