---
title: Using SASS in your next CakePHP project
subtitle: I heard a lot about SASS, mostly a lot of people raving about how it was the best thing since chocolate.
description: >-
  I heard a lot about SASS, mostly a lot of people raving about how it was the
  best thing since chocolate.
tags:
  - sass
  - cakephp
  - preprocessor
  - pre-processor
layout: post
header: sass-cake.gif
image: fb_share.png
date: 2011-04-14
---

{% include carbon.html %}

When I first saw some examples I thought the idea was good, but didn't see the point of learning a new syntax in order to not having to use the CSS syntax. Because, honestly, how does typing some curly brackets and semicolons hurt?

I did like the idea of inheretance by indentation though. By indenting subsequent selectors it saves a lot of repetitive class assigning and declarations. But I hate adding extra layers onto things. It just feels clunky and wrong. But with Compass your .sass files get compiled to proper CSS files that reside in your /webroot/css folder. Cool! How? Read on.

## SASS

SASS is an abbrevation of [Syntactically Awesome Style Sheets][1]. While I don't really agree with the Syntactially Awesome bit, it IS awesome in that it relies on your syntax. It supports nested rules, selector inheretance, mixins, variables, and even more.

## Installing Compass

[Compass][2] is basically an authoring framework which you install that manages your SASS files and offers plugins supporting CSS frameworks such as 960.gs, Susy and Blueprint. It runs from the command line and is just awesome.

For the Mac users it's easy. Open up the Terminal and go:

```bash
$ gem install compass
```

This will utilize Ruby to install Compass for you along with Sass.

## Setting up Compass to work with CakePHP

Now for the fun part, getting Compass to work with Cake! Open up the Terminal again and do:

```bash
$ cd <your project folder>
$ mkdir sass
$ cs sass
$ touch config.rb
```

This sass dir will be our home base for the SASS-stuff. Edit the config.rb file we just created and put in:

```javascript
http_path = "/"
sass_dir = 'src'
css_dir = '../app/webroot/css'
images_dir = '../app/webroot/img'
javascripts_dir = '../app/webroot/js'
http_stylesheets_path = 'css'
http_javascripts_path = 'js'
http_images_path = 'img'
environment = :development
output_style = :compressed
```

This basically tells Compass where we will have our SASS files (sass_dir) and to save the compiled CSS files and where the other diectories are. Not the output_style. This tells Compass how to compile them. I usually have it on :expanded during development so it's easier on the eyes when opening the CSS file.

Now, we're good to go. Go back to the Terminal, and in your sass-directory, type:

```bash
$ compass install blueprint/semantic
```

This is just an example. You can use whatever framework you feel comfortable with, or use the compass default project ones. You will notice the 'src' folder has been created and you have a few Sass files to work on.

I usually create a file `_base.sass` in `src/partials` and in screen.scss add:

```css
@import "partials/base";
```

Notice the underscore in the filename, but not in the import.

In the Terminal, still in your `sass` directory, type:

```bash
$ compass watch
```

This will run Compass in watch-mode and when it detects any changes in the `src` directory, it will automagically save the compiled files to webroot/css

Awesome! So open up your `_base.sass`, start typing Sass, and when you hit Save it will have an awesome stylesheet in your `css` directory.

[1]: http://sass-lang.com/ "Sass - Syntactically Awesome Stylesheets"
[2]: http://compass-style.org/ "Compass"
