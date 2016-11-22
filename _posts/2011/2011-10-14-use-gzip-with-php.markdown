---
title: Use GZip with PHP
description: In this post I will show you how to add GZip to your PHP application
tags:
  - php
publishDate: 2011-10-14T00:00:00.000Z
layout: post
header: gzip.gif
---

I recently started using GZip headers in my websites and the results are simply amazing. Right up there with coffee, sneezing polar bears and green traffic lights.

Nowadays, files are big. People used to optimize graphics and CSS stylesheets. This day and age we just don't care anymore. At the same time bandwidth is getting more expensive and the mobile market is growing bigger. Not a good combination.

## Enter GZip

Adding GZip to your applications couldn't be simpler, and using this compression to your output can reduce the amount of data being sent by around **70-80%** for your average stylesheets. That's what you call weight-loss.

I recently built the backend of a mobile application, which relied on a JSON interface. Data being sent to the phone was around `250kb`. Optimizing the content, only returning the bare minimum the phone needed to work resulted in the file being `197kb`. So, I added the GZip compression and guess what. The resulting file was `14kb`. Awesome.

## So how do I use it

Simple. At the top of your PHP file you add the following:

{% prism php %}
@ob_start ('ob_gzhandler');
header('Content-type: text/html; charset: UTF-8');
header('Cache-Control: must-revalidate');
header("Expires: " . gmdate('D, d M Y H:i:s', time() - 1) . ' GMT');
?>
{% endprism %}

This will tell the server to first zip the contents, before sending it back to the client, where it is deflated.

The only caveat is that you must have `mod_gzip` installed as an Apache module, but most hosting providers install this by default. Just make sure yours does too.

## As a CakePHP component

[Jose Gonzales][1] made a nice little plugin to use GZip in your Cake Applications. Find it at [Github][2] Basically, all you have to do is add the plugin to your `plugins` folder, and then add the following to your `app_controller.php`

{% prism php %}
var $components = array('Gzip.Gzip');
{% endprism %}

And you're good to go.

Enjoy!

[1]: http://josediazgonzalez.com/ "Jose Gonzales"
[2]: https://github.com/josegonzalez/gzip-component/ "CakePHP Gzip Component"
