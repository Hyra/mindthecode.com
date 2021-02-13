@extends('layouts.default')

@section('content')

<div class="max-w-xl">
  <h1 class="text-2xl font-extrabold text-black mb-4">Writing it down</h1>
  <p class="text-grey-darkest text-base leading-normal my-6">I try to note down everything I come across while developing or being part of the development process which I think might be useful to others. If it helps one other person I'm happy.</p>
  <p class="text-grey-darkest text-base leading-normal my-6">These are some of the latest articles I wrote. If you want to see all of the them, be sure to check out the <a href="/archive" class="border-b-2 border-gray-300 font-bold px-1 hover:text-white hover:bg-gray-800 hover:border-b-0">archive</a>.</p>
  <div class="mt-12 space-y-10">
        @foreach ($articles as $article)
        <div>
          <div>
            <a href="{{ Route('articles.show', $article->slug) }}" class="text-lg text-black font-bold no-underline hover:underline">{{$article->title}}</a>
          </div>
          <p class="text-grey-darkest text-base leading-normal mt-1">
            {{$article->description}}
          </p>
          <div class="text-grey-darkest text-base leading-normal mt-2">
            <a href="{{ Route('articles.show', $article->slug) }}" class="text-grey-darker hover:text-black text-sm no-underline hover:underline">Read this article →</a>
          </div>
        </div>
        @endforeach
  </div>
</div>

@stop