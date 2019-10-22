---
title: I made a tool to track your whole site's Pagespeed
subtitle: Don't focus on just the homepage
description: >-
  We usually focus on getting the homepage Pagespeed to 90+, but what about the rest of the pages? I made a tool to help with this.
tags:
  - pet project
  - pagespeed
  - mvp
  - webservice
  - saas
layout: post
header: colourful.gif
image: fb_share.jpg
date: 2017-09-18
---

{% include carbon.html %}

At the office we usually take some time to optimise our client's websites for [Google Pagespeed](https://developers.google.com/speed/pagespeed/insights/). We got quite proficient in this and no what the common pitfalls and best practices are. However, I noticed we usually only do this for the homepage 🤔.

This makes sense, as that's usually the main page, but what about all the other pages. For instance, the order process pages or your contact form. Those are just as, if not more, important to load up quickly.

<!-- Rectangle Ad -->

<!-- <center>
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-0534492338431642"
     data-ad-slot="3199566305"></ins>
</center>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script> -->

This, combined with my desire to launch a webservice at some point, lead me to the idea to create a webapp called [Wulfdeck](https://wulfdeck.com). It automatically crawls the domain you enter and finds all the (internal) pages it links to, up to 2 levels deep. Next, you select which pages you would like to monitor, and you're good to go. Wulfdeck will scan all the pages for their Pagespeed and show you your average, as well as per-page specifics.

The nice thing, I find, is that it calculates with the impact from the various [Pagespeed Rules](https://developers.google.com/speed/docs/insights/rules), so that it can tell you how many more Pagespeed points you will gain by fixing that specific Rule.

When you have changed your page you can re-check it and see if you're at the desired result.

Since I launched it last week I got some subscribers, and luckily the system works as expected without unforeseen server issues or bugs, so that's cool. I'll see where it goes from here.

If you want to give it a spin and give me some feedback that'd be great. Check it out [here](https://wulfdeck.com).

Happy coding (and optimising)!
