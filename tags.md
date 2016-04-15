---
title: About
layout: single
---
<style type='text/css'>
.tagcloud a {
  background: rgba(255, 255, 0, 0.15);
  color: black;
  text-shadow: none;
  padding: 1px 2px;
}
.tagcloud span {
  font-size: 12px;
}
</style>

{% comment %}
<ul class="tags">
{% for tag in site.tags %}
  {% assign t = tag | first %}
  {% assign posts = tag | last %}
  <li>{{t | downcase | replace:" ","-" }} has {{ posts | size }} posts</li>
{% endfor %}
</ul>
{% endcomment %}

<div class='tagcloud'>
{% for tag in site.tags %}
  {% assign t = tag | first %}
  {% assign posts = tag | last %}
  <a href='#{{t | downcase | replace:" ","-" }}'>{{t | downcase | replace:" ","-" }} <span>({{ posts | size }})</span></a>
{% endfor %}
</div>

{% for tag in site.tags %}
  {% assign t = tag | first %}
  {% assign posts = tag | last %}

<a name='{{ t | downcase | replace:" ","-"  }}'></a>
<h3>{{ t | downcase }}</h3>
<ul>
{% for post in posts %}
  {% if post.tags contains t %}
  <li>
    <a href="{{ post.url }}">{{ post.title }}</a>
    <span class="date">{{ post.date | date: "%B %-d, %Y"  }}</span>
  </li>
  {% endif %}
{% endfor %}
</ul>
{% endfor %}
