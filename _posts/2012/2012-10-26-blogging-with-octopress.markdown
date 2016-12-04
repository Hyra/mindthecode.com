---
title: Blogging with Octopress
subtitle: My experiences while converting this blog to an Octopress one
description: My experiences while converting this blog to an Octopress one
tags:
  - octopress
publishDate: 2012-10-26T00:00:00.000Z
layout: post
header: octopress.gif
---

As some of you may know, even though I don't blog all that often, I do mess about with it a lot. Mostly on what makes it run. Switching between [Croogo](http://croogo.org), a custom built [CakePHP](http://cakephp.org) site, [Wordpress](http://wordpress.org) .. and back again.

For some reason none of them really seemed what I wanted. Croogo is cool enough, but actually adding posts is a hassle, and theming the thing was more of a puzle. Wordpress does the blogging thing really well, but it always feels ugly, and I had to rely on various plugins to make my post-flow work. I like writing in [Markdown](http://daringfireball.net/projects/markdown/). There's a couple of Markdown plugins for Wordpress, but I would still have to copy paste stuff in webinterface, and had to hack it to allow for code-snippet sharing.

## Enter Octopress

I somehow stumbled upon [Octopress](http://octopress.org) earlier this week, and decided to give it a go. Short conclusion: _It's awesome_.

<!-- Rectangle Ad -->
<center>
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-0534492338431642"
     data-ad-slot="3199566305"></ins>
</center>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

I won't go into all of the features, as that's nicely explained on their site, but basically it allows for this workflow:

- Run `rake preview` in the background
- Write my posts in [Markdown](http://daringfireball.net/projects/markdown/), with some settings in the top such as title, publish date, etc.
- Hit save
- See the changes in the browser
- When happy, `rake deploy`

Now, the deploy function is very awesome. It automatically generate the site to a `public` folder, commits the whole thing to your git repository, and pushes it. When linked to a Github Pages site it will auto update your site.

So yeah, this is good stuff, as I can just write my plain text files like I want to, and without any further webinterfacing and option clicking I can publish new articles.
