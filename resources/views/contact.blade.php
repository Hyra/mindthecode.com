@extends('layouts.default')

@section('content')
<div class="mx-auto max-w-2xl mt-20">
    <div class="prose prose-xl">
        <h1 class="font-3xl font-bold leading-tight text-gray-900">Getting in touch</h1>
        {!! Markdown::convertToHtml($content) !!}
    </div>
    <div class="mt-16 border-b border-gray-800"></div>
</div>

@stop
