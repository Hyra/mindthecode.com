---
title: Using Markdown in CakePHP
subtitle: Let me show you how you can use Markdown within your next CakePHP project
description: Let me show you how you can use Markdown within your next CakePHP project
tags:
  - markdown
  - cakephp
  - php
layout: post
header: markdown-cakephp.gif
date: 2011-07-10
---

{% include carbon.html %}

Markdown rocks. I lately fell in love with it when I was setting up this very blog. You can just write easy-to-read and easy-to-write plain text files, and Markdown takes care of the rest.

For this blog I had used a Markdown script I found that parses plain text and outputs it as HTML. It allows me to write posts in a simple/plain format and just pump it into the database `as is`. For a while I wanted to make it into a more solid CakePHP Helper. And today I did. Setting it up couldn't be simpler, and using it is a matter of adding it as a call in your views.

I put it on Github @ [Markdown for CakePHP][1] along with the necessary instructions and usage example.

Hope you enjoy it, and if you have any suggestions or tips, don't hesitate to leave a comment or Fork it.

[1]: https://github.com/Hyra/markdown "CakePHP Markdown Github"
