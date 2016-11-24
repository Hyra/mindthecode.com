---
title: Loading external files in PHP the better way
subtitle: Loading external assets with curl is not only easy, it's also a lot faster than file_get_contents
description: >-
  Loading external assets with curl is not only easy, it's also a lot faster
  than file_get_contents
tags:
  - php
publishDate: 2011-12-06T00:00:00.000Z
layout: post
<!-- header: external.gif -->
---

Sometimes you run into "weird behavior" when using `file_get_contents` in your code when retrieving external data. I noticed this for instance when accessing the Facebook Graph API the other day. When using file_get_contents the results were so much different than when using cUrl.

<!-- <div class="teaser" style='background: transparent url(/images/headers/external.gif) no-repeat center center;'></div> -->

Sometimes even, it is disabled on your host for security reasons. So i'm making it a habbit to run everything through cUrl instead. Not just to get the "actual results", but also since it's a lot faster.

## Faster you say?

Indeed! Take this benchmark for instance, `file_get_contents` vs `curl` on google.com:

{% prism javascript %}
[1] => Array   // 1 request to google.com
(
    [FGC] =>  0.4955058 // 38.88% slower
    [CURL] => 0.3582108
)
[5] => Array   // 5 requests to google.com
(
    [FGC] =>  2.2415568 // 24.44% slower
    [CURL] => 1.7973249
)
[10] => Array  // 10 requests to google.com
(
    [FGC] =>  4.7877922 // 29.46% slower
    [CURL] => 3.6951289
)
[25] => Array  // 25 requests to google.com
(
    [FGC] =>  10.932404 // 10.18% slower
    [CURL] => 9.9168329
)
[50] => Array  // 50 requests to google.com
(
    [FGC] =>  22.535982 // 24.74% slower
    [CURL] => 18.068931
)
[100] => Array // 100 requests to google.com
(
    [FGC] =>  44.685283 // 18.57% slower
    [CURL] => 37.688820
)
{% endprism %}

Sure, it might not seem that big a difference. But imagine loading an external file being a big part of your (heavily) used application.

## Got an example ?

Sure, no worries. Rather than calling:

{% prism javascript %}
$data = file_get_contents('http://whatever.com/sheep.jpg');
{% endprism %}

you could do:

{% prism javascript %}
function loadFile($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

$data = loadFile('http://whatever.com/sheep.jpg');
{% endprism %}

And you're done.

## Thoughts?

Anyone else experiencing different results between cUrl and the builtin function? I've been googling what could cause this, but so far nothing conclusive.
