@extends('layouts.default')

@section('content')

<div class="mx-auto max-w-2xl mt-20">
    <div class="prose prose-xl">
        <h1 class="font-3xl font-bold leading-tight text-gray-900">What I use</h1>
        <p>Below you find my current setup, varying from software and extensions to hardware. This list changes frequently as I like to try out new things and am always curious if another application is even better. Sounds familiar?</p>
        {!! $content !!}
    </div>
    <div class="mt-16 border-b border-gray-800"></div>
</div>

@stop
