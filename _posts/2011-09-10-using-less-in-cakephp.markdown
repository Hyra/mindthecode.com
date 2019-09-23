---
title: Using LESS in CakePHP
subtitle: Let me show you how to use a little helper so you can use LESS in your next CakePHP project
description: >-
  Let me show you how to use a little helper so you can use LESS in your next
  CakePHP project
tags:
  - less
  - cakephp
  - php
layout: post
header: less-cakephp.gif
date: 2011-09-10
---

{% include carbon.html %}

I was a bit bored this morning with my previous Less component, so decided to rewrite the thing and added some new features such as caching. It's pretty straightforward and simple to set up. If you can't wait, the code is available [here][1]. For more information, read on.

This little helper converts your .less files into .css without relying on Node.js

## Installation

## Clone

Clone from github: in your plugin directory type:

``` bash
$ git clone https://github.com/Hyra/less.git less
```

## Submodule

Add as Git submodule: in your plugin directory type:

``` bash
$ git submodule add https://github.com/Hyra/less.git less
```

## Manual

Download as archive from github and extract to `app/plugins/less`

Next, create a folder `less` in `app/webroot/` and apply `chmod 777` to it.

## Usage

In your `app_controller.php` add the helper:

``` javascript
public $helpers = array('Less.Less');
```

Now every `.less` file from `webroot/less` will be converted to its `.css` equivalent in `webroot/css`

In your `default.ctp` layout you can just use `echo $this->Html->css('your_css_file');` as you always do

## Features

- Conversion happens on every request while in development mode `(debug at 0)`

Again, it's not much .. but I like simple things that make working on projects more fun, so it's all good.

I probably should update the helper again soon to make it work with CakePHP 2.0, but haven't decided when to make the switch yet. Then again, you guys can always fork and help out, of course ;)

[1]: https://github.com/Hyra/less
