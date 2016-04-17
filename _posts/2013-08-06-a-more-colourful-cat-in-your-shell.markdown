---
title: A more colourful cat in your shell
description: >-
  Let me show you how you can get syntax highlighted output from cat in the
  terminal
tags:
  - terminal
publishDate: 2013-08-06T00:00:00.000Z
layout: post
header: colourful.gif
---

I just wanted to quickly share a shell alias I have been using lately to get some more color in the terminal when you cat a file.

Below is a screenshot of what an [average terminal](/customize-the-terminal/) looks like when you just use

```bash
$ cat somefile.js
```

![Terminal Dull Colours](/images/screenshots/130806_terminal_dull.png "Terminal Dull Colours")

Sure, it does the job, and you probably are ok with it looking dull as hell. But what if you could make it look like this:

![Terminal Colour](/images/screenshots/130806_terminal_colour.png "Terminal Colour")

Indeed! If you could, why wouldn't you?

# The ingredients

So, let's get to it. Luckily this isn't very complex to get going on your machine. Let's start by installing [Pygments](https://github.com/tmm1/pygments.rb). This little Ruby wrapper library is used to make the realtime syntax highlighting possible: bash

```sh
gem install pygments
```

Next up, the alias itself. Depending on your shell and environment open up your profile. If you aren't sure whether you've installed or configured something specifically on your system, chances are the file you are looking for (on OSX at least) is `~/.bashrc`.

In there, add the following alias:

```sh
alias c='pygmentize -O style=monokai -f console256 -g'
```

And that's all there is to it. Now whenever you type `c some-file.ext` it will detect the extension and add syntax highlighting.

I chose the monokai style because it looks awesome and works well with the rest of my ZSH theme, but feel free to try a few and see which works best for you.

Happy CLI-ing!
