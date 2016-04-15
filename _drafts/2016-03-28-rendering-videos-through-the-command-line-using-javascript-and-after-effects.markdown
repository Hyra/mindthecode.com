---
title: "Rendering personalized videos through the CLI using javascript and After Effects"
description: I spent some time exploring the possibilities to render personalized videos programmatically using the CLI and want to share some findings.
tags: ['javascript', 'cli', 'after effects', 'ffmpeg']
publishDate: 2016-03-28
layout: post
header: letsbuild.gif
---

A couple of years ago I created an automated workflow where users could create a personalized video by filling out a form. The form input was used to personalize the video by using the values for text layers and downloading images based on the choice.

Recently, I was asked to do something similar, so I dusted off the old project and am tried to improve on it. I hope sharing some of my findings might be of use to someone.

## Original approach

For the original project I
