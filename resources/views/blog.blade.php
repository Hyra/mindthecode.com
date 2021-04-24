@extends('layouts.default')

@section('content')
<div class="px-2 sm:px-6 lg:px-8 mt-24">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">

        <div class="prose prose-xl mb-10">
            <h1>Writing it down</h1>
            <p>I try to note down everything I come across while developing or being part of the development process which I think might be useful to others. If it helps one other person I'm happy.</p>
        </div>

        <div class="space-y-8">

        <div class="hidden mt-12  mx-auto grid gap-10 md:grid-cols-2 xl:grid-cols-3 md:max-w-none">
            @foreach ($articles as $article)
            <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
              <div class="flex-shrink-0">
                <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1547586696-ea22b4d4235d?ixlib=rb-1.2.1&ixqx=z7inIxSF8i&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80" alt="">
              </div>
              <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                <div class="flex-1">
                  <p class="text-sm font-medium text-red-400">
                    <a href="#" class="hover:underline">
                      Golang
                    </a>
                  </p>
                  <a href="#" class="block mt-2">
                    <p class="text-xl font-semibold text-gray-900">
                        {{$article->title}}
                    </p>
                    <p class="mt-3 text-base text-gray-500">
                        {{$article->description}}
                    </p>
                  </a>
                </div>
                <div class="mt-6 flex items-center">
                  <div class="flex-shrink-0">
                    <a href="#">
                      <span class="sr-only">Roel Aufderehar</span>
                      <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixqx=z7inIxSF8i&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    </a>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">
                      <a href="#" class="hover:underline">
                        Javascript
                      </a>
                    </p>
                    <div class="flex space-x-1 text-sm text-gray-500">
                      <time datetime="2020-03-16">
                        {{ \Carbon\Carbon::parse($article->date)->format('F jS, Y') }}
                      </time>
                      <span aria-hidden="true">
                        &middot;
                      </span>
                      <span>
                        6 min read
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </div>

        @foreach ($articles as $article)
        <div>
            <a href="{{ Route('articles.show', $article->slug) }}" class="block p-0 font-medium text-gray-900 hover:text-red-400">
                <small class="text-base font-light text-gray-500">{{ \Carbon\Carbon::parse($article->date)->format('F jS, Y') }}</small><br />
                {{$article->title}}
                {{-- <p class="font-extralight  text-gray-900">{{$article->description}}</p> --}}
                {{-- <p class="hidden"> --}}
                    {{-- {{$article->description}} --}}
                {{-- </p> --}}
            </a>
        </div>
        @endforeach
    </div>
</div>
</div>

@stop
