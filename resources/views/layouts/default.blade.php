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
              <!-- Mobile menu button-->
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
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
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
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="/blog" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Blog</a>
            <a href="/setup" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Setup</a>
            <a href="/contact" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contact</a>
          </div>
        </div>
      </nav>


      @yield('content')

    {{-- <div class="container mx-auto">

        <div class="flex-col sm:flex-row flex justify-between items-center mb-20">
            <a href="/"><img src="/mtc_logo@2x.png" alt="Mindthecode" width="220" height="35" style="transform: translatey(0px); animation: float 5s ease-in-out infinite;" /></a>
            <div class="mt-3 lg:mt-4 uppercase tracking-wide text-xs space-x-6">
                <a href="/blog" class="text-gray-600 font-semibold no-underline hover:text-red-500 ">Blog</a>
                <a href="/setup" class="text-gray-600 font-semibold no-underline hover:text-red-500 ">Setup</a>
                <a href="/contact" class="text-gray-600 font-semibold no-underline hover:text-red-500 ">Contact</a>
                <a href="https://twitter.com/hyra" rel="noopener" target="_blank" class="hidden sm:inline text-gray-600 font-semibold no-underline hover:text-red-500">
                    <svg class="inline -mt-1" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    Twitter
                </a>
            </div>
        </div>

    </div>

    @yield('content')

    <div class="text-sm pt-5 pb-10 mt-10 text-center">
        <a href="/" ><img src="/mtc_logo@2x.png" alt="Mindthecode" width="120" height="20" class="inline mb-4"  /></a>
        <nav class="mb-6">
            <a href="/" class="inline-block mr-5 text-gray-600 hover:text-red-500">Frontpage</a>
            <a href="/blog" class="inline-block mr-5 text-gray-600 hover:text-red-500">Blog</a>
            <a href="/archive" class="inline-block mr-5 text-gray-600 hover:text-red-500">Archive</a>
            <a href="/setup" class="inline-block mr-5 text-gray-600 hover:text-red-500">Setup</a>
            <a href="/contact" class="inline-block mr-5 text-gray-600 hover:text-red-500">Contact</a>
            <a href="https://twitter.com/hyra" rel="noopener" target="_blank" class="inline-block mr-5 text-gray-600 hover:text-red-500">Twitter</a>
            <a href="https://github.com/hyra" rel="noopener" target="_blank" class="inline-block mr-5 text-gray-600 hover:text-red-500">Github</a>
        </nav>
        <div class="space-y-3">
            <p class="text-dark-dim text-gray-600 text-xs">Made with ❤  and 🍺</p>
            <p class="text-dark-dim text-gray-600 text-xs">Copyright 2011 - {{ \Carbon\Carbon::now()->year }}</p>
        </div>
    </div>

  </div> --}}




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
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
        #carbonads {
            display: flex;
            max-width: 330px;
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
