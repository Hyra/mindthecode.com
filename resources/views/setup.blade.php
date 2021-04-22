@extends('layouts.default')

@section('content')
<div class="max-w-2xl mx-auto mb-auto flex-grow">
    <div class="prose prose-xl">
        <h1 class="font-3xl font-bold leading-tight text-gray-900">What I use</h1>
        <p>Below you find my current setup, varying from software and extensions to hardware. This list changes frequently as I like to try out new things and am always curious if another application is even better. Sounds familiar?</p>
        {!! $content !!}
    </div>
</div>
@stop
