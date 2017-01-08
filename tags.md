---
title: Tags
layout: single
---
{% comment %}
<ul class="tags">
{% for tag in site.tags %}
  {% assign t = tag | first %}
  {% assign posts = tag | last %}
  <li>{{t | downcase | replace:" ","-" }} has {{ posts | size }} posts</li>
{% endfor %}
</ul>
{% endcomment %}

<h1>Tags</h1>

<div class='tagcloud'>
{% assign sorted_tags = site.tags | sort %}
{% for tag in sorted_tags %}
  {% assign t = tag | first %}
  {% assign posts = tag | last %}
  <a href='#{{t | downcase | replace:" ","-" }}'>{{t | downcase | replace:" ","-" }}&nbsp;<span>({{ posts | size }})</span></a>
{% endfor %}
</div>

{% assign sorted_tags = site.tags | sort %}

{% for tag in sorted_tags %}
  {% assign t = tag | first %}
  {% assign posts = tag | last %}

<a name='{{ t | downcase | replace:" ","-"  }}'></a>
<h2>{{ t | downcase }}</h2>
<ul>
{% for post in posts %}
  {% if post.tags contains t %}
  <li>
    <a href="{{ post.url }}">{{ post.title }}</a>
    - <span class="date">{{ post.date | date: "%B %-d, %Y"  }}</span>
  </li>
  {% endif %}
{% endfor %}
</ul>

{% endfor %}
