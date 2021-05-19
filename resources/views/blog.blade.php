@extends('layouts.default')

@section('content')

<div class="mx-auto max-w-2xl mt-20">
    <div class="prose prose-xl">
        <h1 class="font-xl font-bold leading-tight">Writing it down ✍🏻</h1>
        <p>I try to note down everything I come across while developing or being part of the development process which I think might be useful to others. If it helps one other person I'm happy.</p>
    </div>
    <div class="mt-16 border-b border-t border-gray-800"></div>
</div>

<div class="mx-auto max-w-2xl mt-10">

    <div class="space-y-10 prose prose-xl">
        @foreach ($articles as $article)
        <div>
            <div class="text-gray-300 font-semibold list-header">
                <a href="{{ Route('articles.show', $article->slug) }}">{{$article->title}}</a>
            </div>
            <small class="text-blue-200 text-sm">
                {{ \Carbon\Carbon::parse($article->published_at)->format('F jS, Y') }} • {{ ceil(count(explode(" ", Markdown::convertToHtml($article->body_md))) / 200) }} min read
            </small>
            <div class="font-extralight text-gray-200">{!! $article->description !!}</div>
            <div class="flex flex-col items-end">
                <div>
                    <a href="{{ Route('articles.show', $article->slug) }}" class="text-white text-lg hover:text-red-400">Continue reading</a>
                </div>
            </div>
        </div>
        @endforeach

        <div class="mt-16 border-b border-gray-800" style="border-top: 1px solid #151515"></div>

        <div class="flex flex-row justify-between">
            <div class="text-base">
                @if($currentPage > 1)
                    @if($currentPage === 2)
                    <a href="/blog">Previous page</a>
                    @else
                    <a href="/blog/page/{{ $currentPage - 1 }}">Previous page</a>
                    @endif
                @endif</div>
            <div class="text-base">Page {{ $currentPage }}</div>
            <div class="text-base">
                @if($currentPage < $totalPages)
                    <a href="/blog/page/{{ $currentPage + 1 }}">Next page</a>
                @endif
            </div>
        </div>

        <br>
        <br>
        <br>

    </div>

</div>
{{--
<div class="mx-auto max-w-2xl mt-10">
    <div class="space-y-10">
        @foreach ($articles as $article)
        <a href="{{ Route('articles.show', $article->slug) }}" class="block hover:text-white">
        <div class="bg-gray-800 border-gray-700 border hover:border-red-400 rounded px-3 py-2">
            <h2 class="text-gray-300 font-semibold article-heasder">{{$article->title}}</h2>
            <small class="text-blue-200 text-sm">{{ \Carbon\Carbon::parse($article->date)->format('F jS, Y') }}</small><br />
            <p class="font-extralight text-gray-300">{{$article->description}}</p>
        </div>
        </a>
        @endforeach
    </div>
</div> --}}


@stop
