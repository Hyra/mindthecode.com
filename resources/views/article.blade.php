@extends('layouts.default')

@section('content')
<div id="progress" class="h-1 z-20 -inset-0 w-full fixed" style="background:linear-gradient(to right, #fa7369 var(--scroll), transparent 0);"></div>

<div class="max-w-2xl">

<article class="mx-auto">

    <div class="text-lg">
        <div class="text-gray-600 uppercase font-semibold text-xs tracking-wide">
            {{ \Carbon\Carbon::parse($article->date)->format('F jS, Y') }} 
        </div>
        <h1 class="text-3xl font-extrabold text-black leading-tight mt-1 mb-6">{!! $article->title !!}</h1>
        <hr class="border-t border-gray-200">
        <div class="prose mt-6 prose-md">
        {{-- <img src="https://www.rias.be/assets/cats/one.jpg" class="h-60 w-full object-cover" /> --}}
        {!! $article->contents !!}
        </div>
    </div>

    <hr class="border-t border-gray-200 my-5">

    <h2 class="text-xl font-extrabold text-black mb-4">Leave a comment</h2>

    <script src="https://utteranc.es/client.js"
    repo="hyra/mindthecode.com"
    issue-term="pathname"
    label="comment"
    theme="github-light"
    crossorigin="anonymous"
    async>
    </script>

</article>

</div>
@stop

@section('schema')
{!! $blogArticleData->toScript() !!}
@stop

@section('og')
    <meta name="description" content="{{ $article->description }}">
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:type" content="website">
    <meta property="og:description" content="{{ $article->description }}">
    <meta property="og:url" content="https://mindthecode.com/{{ $article->slug }}">
    <meta property="og:site_name" content="Mindthecode.com">
    <meta property="og:image" content="{{ $article->image }}">
    <meta property="twitter:description" content="{{ $article->description }}">
    <meta property="twitter:title" content="{{ $article->title }}">
@stop

@section('scripts')

<script>
var h = document.documentElement,
    b = document.body,
    st = 'scrollTop',
    sh = 'scrollHeight',
    progress = document.querySelector('#progress'),
    scroll;
var scrollpos = window.scrollY;
var header = document.getElementById("header");
var navcontent = document.getElementById("nav-content");

document.addEventListener('scroll', function() {
    /*Refresh scroll % width*/
    scroll = (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
    progress.style.setProperty('--scroll', scroll + '%');

});
</script>
<script src="/prism.js" defer></script>
@stop