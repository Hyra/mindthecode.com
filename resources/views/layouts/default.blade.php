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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    @yield('og')
</head>

<body class="font-sans text-lg leading-normal text-gray-700 bg-gray-50">

    <nav class="py-5 shadow-lg" style="background-color: #0e2231;" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
          <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
              <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" @click="mobileOpen = !mobileOpen">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
              <div class="flex-shrink-0 flex items-center">
                <a href="/"><img src="/mtc_logo_white@2x.png" alt="Mindthecode" width="220" height="35" style="transform: translatey(-15px); animation: float 5s ease-in-out infinite;" /></a>
              </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        <a href="/blog" class="px-3 py-2 rounded-md text-sm font-medium {{ (request()->is('blog') || request()->is('blog/*')) ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}" aria-current="page">Blog</a>
                        <a href="/setup" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('setup') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Setup</a>
                        <a href="/contact" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('cont') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Contact</a>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <div class="sm:hidden" id="mobile-menu" x-show="mobileOpen">
          <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/blog" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Blog</a>
            <a href="/setup" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Setup</a>
            <a href="/contact" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contact</a>
          </div>
        </div>
      </nav>

    @yield('content')

    @yield('scripts')

    {!! $schemawebsite !!}

    @yield('schema')

    <script src="{{ asset('js/app.js') }}" async></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-40203772-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-40203772-4');
    </script>
    <style>
        #carbonads * {
            margin: initial;
            padding: initial;
        }
        #carbonads {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        #carbonads {
            display: block;
            background-color: hsl(0, 0%, 98%);
            box-shadow: 0 1px 4px 1px hsla(0, 0%, 0%, 0.1);
            z-index: 100;
        }
        #carbonads a {
            color: inherit;
            text-decoration: none;
        }
        #carbonads a:hover {
            color: inherit;
        }
        #carbonads span {
            position: relative;
            display: block;
            overflow: hidden;
        }
        #carbonads .carbon-wrap {
            display: flex;
        }
        #carbonads .carbon-img {
            display: block;
            margin: 0;
            line-height: 1;
        }
        #carbonads .carbon-img img {
            display: block;
        }
        #carbonads .carbon-text {
            font-size: 13px;
            padding: 10px;
            margin-bottom: 16px;
            line-height: 1.5;
            text-align: left;
        }
        #carbonads .carbon-poweredby {
            display: block;
            padding: 6px 8px;
            background: #f1f1f2;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            font-size: 8px;
            line-height: 1;
            border-top-left-radius: 3px;
            position: absolute;
            bottom: 0;
            right: 0;
        }
    </style>
</body>

</html>
