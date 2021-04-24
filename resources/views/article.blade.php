@extends('layouts.default')

@section('content')

<div id="progress" class="h-1 z-20 -inset-0 w-full fixed" style="background:linear-gradient(to right, #fa7369 var(--scroll), transparent 0);"></div>

<div class="px-2 sm:px-6 lg:px-8 mt-24">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 flex gap-24">
        <div class="w-4/6">
            <article class="prose prose-xl mx-auto mb-auto">

                <h1 class="mb-0 leading-tight tracking-tight"><span class="font-extralights">{!! $article->title !!}</span></h1>

                <div class="flex items-center justify-center">
                    <div class="flex-1">
                        <small class="text-base font-light">{{ \Carbon\Carbon::parse($article->date)->format('F jS, Y') }}</small>
                    </div>
                    <div class="flex list-none" id="socials">
                        <a href="https://facebook.com/sharer.php?u=https://blog.imgix.com/2020/10/16/api-deprecation" target="_blank" rel="nofollow">
                            <img class="h-10" src="https://assets.imgix.net/blog/social-icons.ai?dpr=3&amp;page=1&amp;fm=png8&amp;bg=fff&amp;cs=strip">
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=Deprecation of Legacy API: New API Keys Bring Improved Functionality&amp;url=https://blog.imgix.com/2020/10/16/api-deprecation&amp;via=imgix&amp;related=imgix" class="share-item twitter" target="_blank" rel="nofollow">
                            <img class="h-10" src="https://assets.imgix.net/blog/social-icons.ai?dpr=3&amp;page=2&amp;fm=png8&amp;bg=fff&amp;cs=strip">
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://mindthecode.com/blog/{{ $article->slug }}&amp;summary=imgix has launched a new API and will be deprecating legacy API keys.&amp;source=imgix" target="_blank" rel="nofollow">
                            <img class="h-10" src="https://assets.imgix.net/blog/social-icons.ai?dpr=3&amp;page=3&amp;fm=png8&amp;bg=fff&amp;cs=strip">
                        </a>
                    </div>
                </div>

                <div class="hidden py-5">
                    <img src="https://www.indiewire.com/wp-content/uploads/2020/05/Rick-and-Morty-Season-4-Episode-7.png?w=780" alt="">
                </div>

                {!! $article->contents !!}

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
        <div class="w-2/6">

            <script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CKYI553J&placement=mindthecode" id="_carbonads_js"></script>

            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laboriosam alias, porro ab suscipit reiciendis non assumenda animi sed? Necessitatibus tempore velit eos deleniti alias esse unde commodi beatae perspiciatis quibusdam.
        </div>
    </div>
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
