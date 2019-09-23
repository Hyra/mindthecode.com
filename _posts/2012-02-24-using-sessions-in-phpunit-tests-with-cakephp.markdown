---
title: Using Sessions in PHPUnit Tests with CakePHP
description: How to use sessions within your unit tests using PHPUnit and CakePHP
tags:
  - phpunit
  - cakephp
  - sessions
  - unit testing
  - testing
layout: post
header: sessions.gif
date: 2012-02-24
---

{% include carbon.html %}

I was breaking my head over failing unit tests when trying to test a simple Controller that was saving a new record.

Turned out it was failing only on the command line, while the webversion was passing all the tests.

Luckily, the solution was simple ..

The PHPUnit command line suite apparently outputs contents early, before the session gets initiated.

## Solution 1

Add `--stderr` to the command line:

``` bash
$ cake testsuite app Controller/YourFancyController --stderr
```

This will pass the tests again, as it doesn't output contents early to `STDOUT`. The only "problem" is you won't see the awesome green and red colors in the CLI output anymore.

## Solution 2

This is the one I use, as it brings the colors back.

As I'm using my self-contained PHPUnit Install, as found on Github @ [PHPUnit-Cake2][1] I am able to edit the following file: `Vendor/PHPUnit/Autoload.php` At the very top of this file, initialize the session early:

``` php
session_start();
```

This will pass the tests again, and even better, bring back the colors!

Maybe the session initialization can be done early by putting it in a file by CakePHP itself, but haven't found the right place yet. Any suggestions?

[1]: https://github.com/hyra/PHPUnit-Cake2
