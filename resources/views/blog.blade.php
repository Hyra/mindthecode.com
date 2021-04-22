@extends('layouts.default')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="prose prose-xl mb-10">
        <h1>Writing it down</h1>
        <p>I try to note down everything I come across while developing or being part of the development process which I think might be useful to others. If it helps one other person I'm happy.</p>
        <p>These are some of the latest articles I wrote. If you want to see all of the them, be sure to check out the <a href="/archive" class="border-b-2 border-gray-300 font-bold px-1">archive</a>.</p>
    </div>
    <div class="space-y-8">
        @foreach ($articles as $article)
        <div>
            <a href="{{ Route('articles.show', $article->slug) }}" class="hover:xbg-gray-50 block rounded-sm p-0 font-medium  text-gray-900 hover:text-red-400">
                <small class="text-base font-light text-gray-500">{{ \Carbon\Carbon::parse($article->date)->format('F jS, Y') }}</small><br />
                {{$article->title}}
                <p class="font-extralight  text-gray-900">{{$article->description}}</p>
                <p class="hidden">
                    {{$article->description}}
                </p>
            </a>
        </div>
        @endforeach
    </div>
</div>

@stop
