<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://srv.carbonads.net" crossorigin>
    <title>Mindthecode{{ isset($article) ? ' | ' . $article->title : ''}}</title>
    <link rel="preconnect" href="//www.gstatic.com" crossorigin>
    <link href="/favicon.png" rel="shortcut icon" type="image/x-icon" />
    @yield('og')
</head>

<body class="text-black leading-tight antialiased">

    <div class="py-8 lg:py-16 px-6 md:px-16 lg:px-24">

        <div class="relative z-20 flex justify-between items-center">
            <div class="flex md:block lg:flex items-center max-w-full">
                <div class="lg:ml-32 md:ml-0">
                    <a href="/"><img src="/mtc_logo@2x.png" alt="Mindthecode" width="220" height="35" style="transform: translatey(0px); animation: float 5s ease-in-out infinite;" /></a>
                    <div class="hidden md:flex mt-3 lg:mt-4 uppercase tracking-wide text-xs space-x-6">
                        <a href="/" class="text-gray-600 font-semibold no-underline hover:text-red-500 {{ (request()->is('/dontuse')) ? 'text-red-500' : '' }}">Frontpage</a>
                        <a href="/blog" class="text-gray-600 font-semibold no-underline hover:text-red-500 {{ (request()->is('blog') || request()->is('blog/*')) ? 'text-red-500' : '' }}">Blog</a>
                        <a href="/archive" class="text-gray-600 font-semibold no-underline hover:text-red-500 {{ (request()->is('archive')) ? 'text-red-500' : '' }}">Archive</a>
                        <a href="/setup" class="text-gray-600 font-semibold no-underline hover:text-red-500 {{ (request()->is('setup')) ? 'text-red-500' : '' }}">Setup</a>
                        <a href="/contact" class="text-gray-600 font-semibold no-underline hover:text-red-500 {{ (request()->is('contact')) ? 'text-red-500' : '' }}">Contact</a>
                        <a href="https://twitter.com/hyra" rel="noopener" target="_blank" class="text-gray-600 font-semibold no-underline hover:text-red-500">
                            <svg class="inline -mt-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        Twitter</a>
                    </div>
                </div>
            </div>
            <div class="block md:hidden"><button class="block focus:outline-none" id="nav-toggle"><svg fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="block text-black h-6 w-6 block"
                        style="display: block;">
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg> <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        class="text-black h-6 w-6 hidden" style="display: none;">
                        <path
                            d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z">
                        </path>
                    </svg></button></div>
        </div>
        <div class="md:hidden z-10 bg-white fixed -inset-0 pt-24 hidden" id="nav-content">
            <div class="space-y-8 overflow-y-auto pt-6 pb-8 px-12 max-h-full">
                <a href="/" class="block text-black font-bold no-underline">Frontpage</a>
                <a href="/blog" class="block text-black font-bold no-underline">Blog</a>
                <a href="/archive" class="block text-black font-bold no-underline">Archive</a>
                <a href="/setup" class="block text-black font-bold no-underline">Setup</a>
                <a href="/contact" class="block text-black font-bold no-underline">Contact</a>
            </div>
        </div>

        <div class="lg:pl-32 mt-12">
            @yield('content')
        </div>

    </div>

<div>
    <div class="px-5">
      <div class="constrain constrain-lg">
        <div class="text-sm pt-5 pb-10 text-center">
            <a href="/" ><img src="/mtc_logo@2x.png" alt="Mindthecode" width="120" height="20" class="inline mb-4"  /></a>
          <nav class="mb-6">
            <a href="/" class="inline-block mr-5 text-gray-600 hover:text-red-500">Frontpage</a>
            <a href="/blog" class="inline-block mr-5 text-gray-600 hover:text-red-500">Blog</a>
            <a href="/archive" class="inline-block mr-5 text-gray-600 hover:text-red-500">Archive</a>
            <a href="/setup" class="inline-block mr-5 text-gray-600 hover:text-red-500">Setup</a>
            <a href="/contacts" class="inline-block mr-5 text-gray-600 hover:text-red-500">Contact</a>
            <a href="https://twitter.com/hyra" rel="noopener" target="_blank" class="inline-block mr-5 text-gray-600 hover:text-red-500">Twitter</a>
            <a href="https://github.com/hyra" rel="noopener" target="_blank" class="inline-block mr-5 text-gray-600 hover:text-red-500">Github</a>
          </nav>
          <div class="space-y-3">
          <p class="text-dark-dim text-gray-600 text-xs">Made with ❤  and 🍺</p>
          <p class="text-dark-dim text-gray-600 text-xs">Copyright 2011 - {{ \Carbon\Carbon::now()->year }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>

    @yield('scripts')

    {!! $schemawebsite !!}

    @yield('schema')

    <script src="{{ asset('js/app.js') }}" async></script>    
    <script>
        document.getElementById('nav-toggle').onclick = function () {
            document.getElementById("nav-content").classList.toggle("hidden");
        }
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-40203772-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-40203772-4');
    </script>
    <style>
        #carbonads {
        padding: 1rem;
        --bg-opacity: 1;
        background-color: ivory;
        background-color: rgba(255, 255, 240, var(--bg-opacity));
        border-width: 1px;
        --border-opacity: 1;
        border-color: #faf089;
        border-color: rgba(250, 240, 137, var(--border-opacity));
        font-size: 0.75rem;
        --text-opacity: 1;
        color: #4a5568;
        color: rgba(74, 85, 104, var(--text-opacity));
        line-height: 1.375;
        margin-left: auto;
        margin-right: auto;
        margin-top: 2.5rem;
        margin-bottom: 2.5rem;
        max-width: 24rem;
    }
    @media (prefers-color-scheme: dark) {
        #carbonads {
            --bg-opacity: 1;
            background-color: #000;
            background-color: rgba(0, 0, 0, var(--bg-opacity));
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity));
            --border-opacity: 1;
            border-color: #000;
            border-color: rgba(0, 0, 0, var(--border-opacity));
        }
    }
    #carbonads > span {
        display: grid;
        grid-gap: 0.5rem;
        grid-template-areas: "img" "text" "poweredby";
    }
    @media (min-width: 640px) {
        #carbonads > span {
            grid-gap: 1rem;
            grid-template-areas: "img text" "img poweredby";
        }
    }
    .carbon-img {
        grid-area: img;
    }
    .carbon-text {
        grid-area: text;
    }
    .carbon-poweredby {
        grid-area: poweredby;
    }
    .carbon-wrap {
        display: contents;
    }
    #carbonads a {
            box-shadow: none;
            border: none;
    }
    #carbonads a:hover {
        background: none;
        color: black;
    }
    #carbonads img {
            margin: 0;
    }
    </style>
</body>

</html>