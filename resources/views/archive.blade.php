@extends('layouts.default')

@section('content')

<div class="max-w-xl">
  <h1 class="text-2xl font-extrabold text-black mb-4">The archive</h1>
  <p class="text-grey-darkest text-base leading-normal my-6">How convenient, all blog posts I've written neatly in one long list, for you to enjoy.</p>
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