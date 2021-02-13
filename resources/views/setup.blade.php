@extends('layouts.default')

@section('content')

<div class="max-w-xl">
  <h1 class="text-2xl font-extrabold text-black mb-4">What I work with</h1>
  <div class="prose">
    <p>Below you find my current setup, varying from software and extensions to hardware. This list changes frequently as I like to try out new things and am always curious if another application is even better. Sounds familiar?</p>
    {!! $content !!}
  </div>
</div>

@stop