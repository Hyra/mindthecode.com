---
title: "Spotify Preview Build expired"
tags: spotify
publishDate: 2012-02-11
template: post.jade
---

Today I decided to tinker some more on our Spotify App, only to find that the Preview Build had expired, and was not gonna launch. Period. Great, so now what?

## Small update

From IRC:

> chiel: Hi guys, just a small update about the expired preview build we're aware of the issue and will put a new one up today however, we're in San Francisco for a hackday, where it is now 8.30am, so bear with us for a moment.

## Back to basics

I downloaded the normal user version, and obviously my application didn't fully work. Most noticably the `application` node had disappeared from the `models` class, even though it's still present at the developer resource page.

This means one can't change tabs in the following way anymore:

    application.observe(models.EVENT.ARGUMENTSCHANGED, handleArgs);

    function handleArgs() {
        var args = models.application.arguments;
        $(".section").hide();   // Hide all sections
        $("#"+args[0]).show();  // Show current section
    }


## So now what?

I did some digging, and noticed `sp.core` has some eventListeners. After some fiddling I can now switch tabs again by doing the following:

    sp.core.addEventListener('argumentsChanged', function() {
        $(".section").hide();                   // Hide all sections
        $("#"+sp.core.getArguments()).show();   // Show current section
    });


Nothe most elegant, and I'll probably be able to change it back to the original code when the new Preview Build comes out, but for now I can at least work on the App.

## Broken?

Any one else noticing things that have stopped working and found some workarounds? Do share below!
