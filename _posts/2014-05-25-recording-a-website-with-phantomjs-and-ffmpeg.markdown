---
title: "Recording a website with PhantomJS and FFMpeg"
description: When I realised you could easily generate screenshots from a site with PhantomJS I just needed to know if I could take it one step further, and record a video.
tags: ['ffmpeg', 'phantomjs']
publishDate: 2014-05-25
layout: post
header: recording-phantomjs.gif
---

When I realised you could easily generate screenshots from a site with PhantomJS I just needed to know if I could take it one step further, and record a video.

## The goal

What I wanted was to record 10 seconds of video from a random website and output it as a .mp4. For this short demo I decided we should go with one of the fun examples on Pixi.JS as they're interesting to capture.

Here it is, a <a href="http://www.goodboydigital.com/pixijs/examples/12-2/" target="\_blank">Pixi dragon</a>

## The ingredients

### PhantomJS

In case you've been hiding, [PhantomJS](http://phantomjs.org/) is a headless scriptable webkit browser with a Javascript API. We will use it to generate screenshots of a site.

### FFMPeg

[FFMPeg](http://www.ffmpeg.org/) is our all purpose video and audio toolbox to record, convert and stream on the command line.

With these two tools installed we are ready to create a video.

## From the top

Capturing a webpage as an image with PhantomJS is easy stuff. They have a example on how to do this [over here](https://github.com/ariya/phantomjs/blob/master/examples/technews.js), so let's strip it down to what we need and save it as `runner.js`

{% highlight javascript %}
var page = require('webpage').create();
page.viewportSize = { width: 640, height: 480 };

page.open('http://www.goodboydigital.com/pixijs/examples/12-2/', function () {
  page.render('dragon.png', { format: "png" });
  phantom.exit();
});
{% endhighlight %}

We can now run this with:

{% highlight bash %}
$ phantomjs runner.js
{% endhighlight %}

After a few moments PhantomJS will have booted up and rendered an image. But .. it's white! That's because PhantomJS takes the image before the `<canvas>` has actually fully loaded and started the animation. Let's add a little delay before we write the image.


{% highlight javascript %}
var page = require('webpage').create();
page.viewportSize = { width: 640, height: 480 };

page.open('http://www.goodboydigital.com/pixijs/examples/12-2/', function () {
  setTimeout(function() { // Add a little delay before capturing the image
    page.render('dragon.png', { format: "png" });
    phantom.exit();
  }, 666);
});
{% endhighlight %}

This time, you should end up with an image of .. a dragon!

![Pixi Dragon](/images/screenshots/dragon01.png)

## Rendering multiple images

From here it's easy enough to render multiple images with an interval. Create a folder `frames` and modify the runner code to capture 50 images:

```javascript
var page = require('webpage').create();
page.viewportSize = { width: 640, height: 480 };

page.open('http://www.goodboydigital.com/pixijs/examples/12-2/', function () {
  setTimeout(function() {
    // Initial frame
    var frame = 0;
    // Add an interval every 25th second
    setInterval(function() {
      // Render an image with the frame name
      page.render('frames/dragon'+(frame++)+'.png', { format: "png" });
      // Exit after 50 images
      if(frame > 50) {
        phantom.exit();
      }
    }, 25);
  }, 666);
});
```

Sweet, we end up with 50 frames of the dragon. When flicking through them it looks like it's flying, so we're almost there!

## Rendering a movie

Now we know how to get the frames we want, we need to figure out how to feed them to ffmpeg. Traditionally, one would first render all the frames and then use an ffmpeg command to stitch the images to a movie. This would look a bit like this:

```bash
$ ffmpeg -start_number 10 -i frames/dragon%02d.png -c:v libx264 -r 25 -pix_fmt yuv420p out.mp4
```

Notice I added a `-start_number` parameter because the frames we generated don't have a leading 0.

So, at this point we have a movie from the site we wanted. Good stuff, but we can do better. Wouldn't it be nice if we could squeeze it all in one command? We can! If we modify the runner code to output images to the terminal, we can pipe it as food to ffmpeg, which accepts the `image2pipe` parameter.

Let's alter the render method a bit:

{% highlight javascript %}
var page = require('webpage').create();
page.viewportSize = { width: 640, height: 480 };

page.open('http://www.goodboydigital.com/pixijs/examples/12-2/', function () {
  setInterval(function() {
    page.render('/dev/stdout', { format: "png" });
  }, 25);
});
{% endhighlight %}

We have removed the timeout as we don't need it anymore and we took out the frame counting code as we will tell ffmpeg how long to record for.

Now, when we run the runner again, the CLI will throw raw image data at us, so don't! :)

Instead, let's add a pipe to it and feed that juicy image data to ffmpeg instead, who can devour it much better than we can:

```bash
$ phantomjs runner.js | ffmpeg -y -c:v png -f image2pipe -r 25 -t 10  -i - -c:v libx264 -pix_fmt yuv420p -movflags +faststart dragon.mp4
```

This might take a while, but eventually you will end up with a file `dragon.mp4` that's a lot smoother than our first attempt. This is because we feed a lot more images to ffmpeg.

The important flags to notice in the ffmpeg command is `-t 10` which tells it to limit the capture to 10 seconds, and `-f image2pipe` because it tells ffmpeg to listen to the image stream we created.

![Pixi Dragon](/images/screenshots/dragon.gif)

## Wrapping it up

And there we go. We can stream images through PhantomJS and feed them to ffmpeg to create a movie. I haven't thought of a practical purpose for this, but maybe someone else will.

I hope you like the proof of concept.

Happy coding!
