---
title: The best boilerplate app is the one you code yourself
subtitle: Procrastination vs productivity
description: >-
  Boilerplate apps are great. They let you get your next project up and running quickly, and usually provide some form of structure you can follow. But the best boilerplate app is the one you code yourself.
tags:
  - boilerplate
  - mvp
  - web application
  - coding
layout: post
header: boiler.gif
image: fb_share.png
date: 2017-11-07
references:
---

{% include carbon.html %}

Boilerplate apps are great. They let you get your next project up and running quickly, and usually provide some form of structure you can follow.

They can also, however, be a massive **time-sink**. We developers are curious by nature, and tend to have this thing where we want to know exactly how things run under the hood 🙈 In addition, boilerplates can be too minimalistic for your needs, or too much bloat. This means you either spend time adding base-features, or scraping off the excess things you don't need.

This process is not a bad thing in itself, obviously, but it can easily lead to procrastination. Time you could probably better spend building that awesome feature, instead!

## Should we use boilerplates?

YES! I'm not saying we shouldn't use boilerplates. Quite the opposite, actually. Building a project from scratch will most always be far more time consuming than using a boilerplate. The trick is using the **right** boilerplate for your project. I really believe the boilerplate you should be using is the one you code yourself. Creating your own boilerplate not only teaches you a **ton** about the technology you are using, it also leaves you with a piece of base-code you know inside out and can use to start working on that next project.

Of course you don't have to start from scratch with this. You can pick any existing boilerplate that almost works for you, and then customize it so it works perfectly for you. Or your team.

## But not all projects are the same!

Agreed. Even more so, not every _environment_ is the same. Or project team, for that matter. For instance, you might use a completely different stack when you are working on your pet side-projects than what you use at the office. Personally, I work with about 4 boilerplate apps, depending on the project, the people I work with and sometimes the constraints set by the client. For example, I have boilerplates for:

* a Single Page VueJS App
* an API only Express application
* a Static Site Generator (Hexo) for blogs
* etc.

The idea is that you standardize as much as possible, but don't constrain yourself too much. Sure, every project and situation is different, but starting every project from a **base** you are very familiar with makes sure you can get up and running quickly.

## Keeping up to date

Ideally, you should keep your boilerplate apps up to date. Make sure to check your dependencies are up to date every now and then, check if it still works, and see if there's any upgrades you should be aware of. Over time you will know exactly what works, and what doesn't, so when that new library comes along you know exactly where to fit it in. But, **don't do this religously**, else we end up tinkering on Boilerplate apps rather than projects that will let you take over the world

It's all about that fine balance 🦄 ✨

<!-- <center>![Balance](/images/balance.gif "Balance")</center> -->

## Express Firestarter

In my next post I'll walk you through one of my own boilerplate apps: **Express Firestarter**. It's what I tend to use for my personal side projects and is a combination of Express, SocketIO, Redis and Mongoose. I'll go through the steps I took to create it and what goes where. So stay tuned :)
