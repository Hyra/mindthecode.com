---
title: Sorting tags in Jekyll
subtitle: A short tip on how to sort your tags in your Jekyll blog
description: How to sort your site.tags alphabetically in your Jekyll blog
tags:
  - javascript
  - cli
  - after effects
  - ffmpeg
publishDate: 2016-03-28T00:00:00.000Z
layout: post
---

<div class="teaser" style='background: transparent url(/images/headers/sorting.gif) no-repeat center center;'></div>

On this blog I list all the used tags in the sidebar. I realised these tags were listed _randomly_ so wanted to know if you could sort them alphabetically.

Turns out you can.

## Tagging posts
In your posts, make sure you tag your posts in the meta section:

{% prism markdown %}
title: Your awesome title
tags:
	- something
	- here
	- three
{% endprism %}

Now, Jekyll is clever and knows about your tags and stores them in `site.tags`. To display a list of them, use the following snippet:

{% prism markup %}
<h2>Tags</h2>
<ul>
{{ "{% assign sorted_tags = site.tags | sort " }}%}
{{ "{% for tag in sorted_tags " }}%}
  {{ "{% assign t = tag | first " }}%}
  {{ "{% assign posts = tag | last " }}%}
  <li>
  	<a href="/tags/# {{ "{{ t | downcase | replace:' ','-'" }}}}">
		{{ "{{t | downcase | replace:' ','-' " }}}} 
  		<span>({{ "{{ posts | size " }}}})</span>
  	</a>
  </li>
{{ "{% endfor " }}%}
</ul>
{% endprism %}

So first Jekyll gets all tags, and pipes them through the sort function. Next we iterate over them and link to a page passing the tag for optional use on the target page. Behind the tag we can use the **size** pipe to show how many posts are tagged with the current tag.

Good stuff.

If you have any questions feel free to reach me at [@stefvdham](http://twitter.com/stefvdham) or in the comments below.

Happy coding!

