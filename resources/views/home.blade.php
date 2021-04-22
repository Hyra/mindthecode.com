@extends('layouts.default')

@section('content')

<div class="container mx-auto mb-auto">

    <header class="mb-4 flex items-center justify-between">
        <div class="prose prose-xl">
            <h1 class="font-xl font-bold leading-tight text-gray-900">Heya 👋</h1>
            <p>I'm <a href="https://twitter.com/hyra" class="border-b-2 border-gray-300 font-bold px-1 hover:border-b-0">@hyra</a>, entrepeneur, web-developer, tooling enthusiast, martial artist and experienced procrastinator from Amsterdam.</p>
            <p>I enjoy building useful and useless applications in <a href="https://nodejs.org/en/" class="border-b-2 border-gray-300 font-bold px-1 hover:border-b-0">Node</a>, <a href="https://vuejs.org/" class="border-b-2 border-gray-300 font-bold px-1 hover:border-b-0">VueJS</a>, <a href="https://laravel.com/docs/8.x" class="border-b-2 border-gray-300 font-bold px-1 hover:border-b-0">Laravel</a> or bash. Recently picked up <a href="https://golang.org/" class="border-b-2 border-gray-300 font-bold px-1 hover:border-b-0">Golang</a> as well.<p>
            <p>During the day I work as CTO at <a href="https://noprotocol.nl" class="border-b-2 border-gray-300 font-bold px-1 hover:border-b-0">NoProtocol</a> where we build complete solutions for ambitious clients.</p>
            <p>On this blog I write about my findings, struggles and solutions I encounter during my development experiences. Both during developing and managing the process in a team.</p>
        </div>
        <div class="hidden lg:block flex-shrink-0 mx-auto">
            <img class="rounded-full h-72 w-72" src="https://scontent-ams4-1.cdninstagram.com/v/t51.2885-15/e35/s1080x1080/152503070_282300290057607_8928206356552139433_n.jpg?tp=1&_nc_ht=scontent-ams4-1.cdninstagram.com&_nc_cat=103&_nc_ohc=aKYTv2vg5soAX_GWGxm&edm=AP_V10EAAAAA&ccb=7-4&oh=24a2dab83ea645a7e4c773f2ed8d1b85&oe=60991F25&_nc_sid=4f375e" width="2048" height="2048">
        </div>
    </header>

</div>
@stop

@section('og')
    <meta name="description" content="I'm Stef van den Ham (@hyra), entrepeneur, web-developer, tooling enthusiast, martial artist and experienced procrastinator from Amsterdam. Writing about all things web.">
    <meta property="og:title" content="Mindthecode.com">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Writing about all things web.">
    <meta property="og:url" content="https://mindthecode.com">
    <meta property="og:site_name" content="Mindthecode.com">
    <meta property="og:image" content="https://mindthecode.com/fb_share.jpg">
    <meta property="twitter:description" content="Writing about all things web.">
    <meta property="twitter:title" content="Mindthecode.com">
@stop
