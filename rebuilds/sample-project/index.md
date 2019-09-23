---
layout: post
skip_title: true
nav: rebuilds
title: Sample project
rebuild: true
summary: A free iPad app to help create beautiful, immersive documents that look great on any device
---

Explanation of the project

{% assign sorted_pages = site.pages | sort:"date" %}

{% for page in sorted_pages reversed %}
{% if page.sampleproject == true %}
{% if page.hidden != true %}

<article>
<header class="heading">
{% if page.link %}
<h1 class="page-title"><a href="{{ page.link }}">
{% else %}
<h1 class="page-title"><a href="{{ page.url | replace: '/index.html', '' }}">
{% endif %}
{{ page.title }}</a></h1>
<p class="timestamp">{{ page.summary }}</p>
</header>
</article>
{% endif %}
{% endif %}
{% endfor %}
