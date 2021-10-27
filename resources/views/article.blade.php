@extends('layouts.default')

@section('content')

    <div id="progress" class="h-1 z-20 -inset-0 w-full fixed"
        style="background:linear-gradient(to right, #fa7369 var(--scroll), transparent 0);"></div>

    <div class="mx-auto max-w-2xl mt-20 px-5 md:px-0">
        <article class="prose prose-xl mx-auto mb-auto">

            <h1 class="mb-0 leading-tight tracking-tight"><span class="font-extralights">{!! $article->title !!}</span></h1>

            <div class="flex items-center justify-center">
                <div class="flex-1">
                    <small class="text-blue-300 text-base font-light">
                        Posted {{ \Carbon\Carbon::parse($article->published_at)->format('F jS, Y') }} •
                        {{ ceil(count(explode(' ', Markdown::convertToHtml($article->body_md))) / 200) }} min read
                    </small>
                </div>
                <div class="flex list-none" id="socials">
                    <a href="https://facebook.com/sharer.php?u=https://mindthecode.com/blog/{{ $article->slug }}"
                        class="share-item" target="_blank" rel="nofollow">
                        <img class="h-10" src="/images/socials/facebook.png" width="40" height="40">
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ $article->title }}&amp;url=https://mindthecode.com/blog/{{ $article->slug }}&amp;via=mindthecode&amp;related=mindthecode"
                        class="share-item" target="_blank" rel="nofollow">
                        <img class="h-10" src="/images/socials/twitter.png" width="40" height="40">
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://mindthecode.com/blog/{{ $article->slug }}&amp;summary={{ $article->title }}&amp;source=mindthecode"
                        class="share-item" target="_blank" rel="nofollow">
                        <img class="h-10" src="/images/socials/linkedin.png" width="40" height="40">
                    </a>
                </div>
            </div>

            {!! Markdown::convertToHtml($article->body_md) !!}

        </article>

        <div class="my-8 border-b border-gray-800"></div>

        <div class="p-3 rounded-md" id="mc_embed_signup">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6" id="mc_embed_signup_scroll">
                    <h3 class="text-xl leading-6 font-medium text-gray-900">
                        Stay up to date
                    </h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>
                            Want to know when a new post comes out and stay in the loop on tips, tricks and gotchas?
                            Consider signing up for the Mindthecode newsletter.
                        </p>
                    </div>
                    <form
                        action="https://mindthecode.us8.list-manage.com/subscribe/post?u=81bc331f4f2d0e26941705aa8&amp;id=9085d5fa6a"
                        method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
                        class="validate mt-5 sm:flex sm:items-center" target="_blank" novalidate>
                        <div class="w-full sm:max-w-xs mc-field-group">
                            <label for="mce-EMAIL" class="sr-only">Email</label>
                            <input type="email" name="EMAIL" id="mce-EMAIL"
                                class="required email shadow-sm py-2 px-2 focus:ring-gray-300 focus:border-gray-300 block w-full sm:text-sm border border-gray-300 rounded-md"
                                placeholder="hantori@hanzo.com">
                        </div>
                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                                name="b_81bc331f4f2d0e26941705aa8_9085d5fa6a" tabindex="-1" value=""></div>
                        <button type="submit" id="mc-embedded-subscribe"
                            class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm rounded-md text-white bg-red-400 hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm font-serif font-bold">
                            Sign me up!
                        </button>
                    </form>
                    <div id="mce-responses" class="clear">
                        <div class="response" id="mce-error-response" style="display:none"></div>
                        <div class="response" id="mce-success-response" style="display:none"></div>
                    </div>
                    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
                    <script type='text/javascript'>
                        (function($) {
                            window.fnames = new Array();
                            window.ftypes = new Array();
                            fnames[0] = 'EMAIL';
                            ftypes[0] = 'email';
                            fnames[1] = 'FNAME';
                            ftypes[1] = 'text';
                            fnames[2] = 'LNAME';
                            ftypes[2] = 'text';
                        }(jQuery));
                        var $mcj = jQuery.noConflict(true);
                    </script>
                </div>
            </div>
        </div>

        <div class="my-8 border-b border-gray-800"></div>

        <h3 class="text-2xl text-white">Comments</h3>
        <script src="https://utteranc.es/client.js" repo="hyra/mindthecode.com" issue-term="pathname" label="comment"
                theme="dark-blue" crossorigin="anonymous" async>
        </script>

        <div class="my-8 border-b border-gray-800"></div>

        <h3 class="text-2xl text-white mb-5">Keep reading</h3>

        <div class="prose">
            @foreach ($randomArticles as $randomArticle)
                <div>
                    <div class="text-gray-800 font-bold list-header font-serif">
                        <a href="{{ Route('articles.show', $randomArticle->slug) }}">{{ $randomArticle->title }}</a>
                    </div>
                    <small class="text-blue-200 text-sm">
                        {{ \Carbon\Carbon::parse($randomArticle->published_at)->format('F jS, Y') }} •
                        {{ ceil(count(explode(' ', Markdown::convertToHtml($randomArticle->body_md))) / 200) }} min read
                    </small>
                    <div class="font-extralight text-gray-200">{!! $randomArticle->description !!}</div>
                    <div class="flex flex-col items-end">
                        <div>
                            <a href="{{ Route('articles.show', $randomArticle->slug) }}"
                                class="text-white text-sm hover:text-red-400">Continue reading</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <br>
        <br>
        <br>
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
    <meta property="og:url" content="https://mindthecode.com/blog/{{ $article->slug }}">
    <meta property="og:site_name" content="Mindthecode">
    <meta property="og:image" content="https://mindthecode.com/{{ $article->image ?? 'fb_share.jpg' }}">
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
