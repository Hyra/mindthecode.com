---
title: 'HTTPIe, a command line HTTP client'
subtitle: Curl on steroids with an easy interface and syntax highlighted output.
description: Curl on steroids with an easy interface and syntax highlighted output.
tags:
  - http
  - command line
  - cli
  - osx
layout: post
header: httpie.gif
date: 2013-12-08
---

Stumbled upon **[HTTPie](https://github.com/jkbr/httpie)**, a command line HTTP client. It's pretty awesome. Basically it's Curl on steroids, as it has an easy interface and syntax highlighted output.

Here's an example of a simple GET request to the [Bacon Ipsum JSON service](http://baconipsum.com/api/):

![HTTPie](/images/screenshots/131208_http.png)

Of course you can do actual useful stuff as well, such as POST-ing, Authentication, Cookies, Custom Headers, etc.

As the repo says, the main features are:

* Expressive and intuitive syntax
* Formatted and colorized terminal output
* Built-in JSON support
* Forms and file uploads
* HTTPS, proxies, and authentication
* Arbitrary request data
* Custom headers
* Persistent sessions
* Wget-like downloads
* Python 2.6, 2.7 and 3.x support
* Linux, Mac OS X and Windows support
* Documentation
* Test coverage

I haven't played with it much yet, but so far it seems like a rather useful little tool, worth checking out.

You can get it [here](https://github.com/jkbr/httpie)
