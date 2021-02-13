@extends('layouts.default')

@section('content')

<div class="max-w-xl">
  {{-- <img class="mb-12 lg:mb-0 lg:mr-12 rounded" src="https://mindthecode.com/profile.jpg" alt="Christoph Photo" width="200" height="200"> --}}
  <h1 class="text-2xl font-extrabold text-black mb-4">Heya 👋</h1>

  <div class="prose">
    <p>I'm <a href="https://twitter.com/hyra" class="border-b-2 border-gray-300 font-bold px-1 hover:text-white hover:bg-gray-800 hover:border-b-0">@hyra</a>, entrepeneur, web-developer, tooling enthusiast, martial artist and experienced procrastinator from Amsterdam.</p>
    
    <p>I enjoy building useful and useless applications in <a href="https://nodejs.org/en/" class="border-b-2 border-gray-300 font-bold px-1 hover:text-white hover:bg-gray-800 hover:border-b-0">Node</a>, <a href="https://vuejs.org/" class="border-b-2 border-gray-300 font-bold px-1 hover:text-white hover:bg-gray-800 hover:border-b-0">VueJS</a>, <a href="https://laravel.com/docs/8.x" class="border-b-2 border-gray-300 font-bold px-1 hover:text-white hover:bg-gray-800 hover:border-b-0">Laravel</a> or bash. Recently picked up <a href="https://golang.org/" class="border-b-2 border-gray-300 font-bold px-1 hover:text-white hover:bg-gray-800 hover:border-b-0">Golang</a> as well.<p>

    <p>During the day I work as CTO at <a href="https://noprotocol.nl" class="border-b-2 border-gray-300 font-bold px-1 hover:text-white hover:bg-gray-800 hover:border-b-0">NoProtocol</a> where we build complete solutions for ambitious clients.</p>

    <p>On this blog I write about my findings, struggles and solutions I encounter during my development experiences. Both during developing and managing the process in a team.</p>
  </div>
  {{-- <p class="font-display text-textBlue text-2xl lg:text-3xl max-w-2xl mb-3">Heya, I'm Stef 👋 I write SASS, HTML5, Javascript, PHP, Node and Bash for fun and profit.</p> --}}
  {{-- <p class="font-display text-textBlue text-2xl lg:text:lg max-w-2xl">I work as CTO at NoProtocol in Amsterdam. When not fondling with NodeJS or websockets I like to twiddle with Arduino’s and making useful and useless things with hardware.</p> --}}
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