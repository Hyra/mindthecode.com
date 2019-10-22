---
title: Setting up CakePHP with MAMP Pro on Mac OSX
subtitle: Get your site running locally in the simple way.
description: >-
  I'd like to use my first post to describe how I set up new projects in a
  simple way that works best for me.
tags:
  - php
  - cakephp
  - osx
  - mamp
layout: post
image: fb_share.jpg
date: 2011-04-11
---

{% include carbon.html %}

I'd like to use my first post to describe how I set up new projects in a simple way that works best for me. My setup is pretty straight-forward, really. I know some people who mess about with include-paths so they can run _multiple apps_ on one cake-install, but since I work for various clients and even more various projects I like my project folders to be self-contained.

## Downloading CakePHP

Easy enough. Grab a fresh copy of [CakePHP @ Github][1]

Unzip the package and copy the extracted folder to your Sites directory (mine is in `/Users/Hyra/Sites`) and rename the folder to the project you want to work on. For example: www.fantasticnewsite.org

## Setting up CakePHP

I won't go through the all of the options as it's perfectly documented [here at the CakePHP Book][2] but what I usually do is the following:

1.  Rename `/app/config/database.php.default` to `/app/config/database.php` and fill in the database credentials in `$default`
2.  Open up the Terminal and run (for example):<br>
    `chmod 777 ~/Sites/www.fantasticnewsite.org/app/tmp`
3.  Open up /app/config/core.php and change the values for:<br>
    `Security.salt`<br>
    `Security.cipherSeed`

That's it really. Of course, there's a bunch of extra stuff you can set up, but that's all outlined [here][3] if you want to read up on it.

## Setting up MAMP Pro

Optional. If you have any form of \*AMP setup already running, by all means, skip this step. I just happen to run MAMP Pro for ease and comfort.

Open up MAMP Pro and go to the Hosts tab and simply:

1.  Hit the plus-sign
2.  Give the site a name at which you want to access it locally
3.  Browse to the location you want the site to be located
4.  Hit apply

By this point you should be able to point your [favourite browser][4] to your fresh local domain at <http://www.fantasticnewsite.org>

[1]: https://github.com/cakephp/cakephp/downloads
[2]: http://book.cakephp.org/#!/view/912/Installation "The Manual :: 1.3 Collection"
[3]: http://book.cakephp.org/#!/view/915/Advanced-Installation "The Manual :: 1.3 Collection"
[4]: http://www.mozilla.com/en-US/firefox/new/ "Mozilla | Firefox web browser & Thunderbird email client"
