---
title: "Good times with Watchr, Coffeescript and LESS"
description: With this little gem you can watch specific folders or file extensions and run commands based on the files you watch.
tags: ['less', 'coffeescript']
publishDate: 2012-05-16
layout: post
header: good-times.gif
---

I have been working on a pure HTML front-end for one of the pet projects I'm doing. A lot of fun, but while developing, running the terminal commands to compile both the .less and .coffee files gets a tad tedious. ["Watchr"][1] to the rescue! With this little gem you can watch specific folders or file extensions and run commands based on the files you watch.

Here is how I got it set up now ..

## Installing watchr

First of all we need to get the Watchr gem installed. Assuming you have a Mac and got XCode (or at least the tools) installed, this is pretty simple:

    $ gem install watchr


## Installing coffeescript

Another easy one ..

    $ npm install -g coffee-script

Don't forget the `-g` flag as you (probably) want it to be installed globally.

## Installing the LESS compiler

You got the hang of it now, it's as easy as ..

    $ npm install -g less

## The fun part!

Now we're ready for the fun bit, setting up watchr to do some automagic stuff.

I have a typical folder structure, with the exception of a new `_src` folder which will contain all the raw coffeescript and less files.

    /index.html
    /css
    /js
    /img
    /_src
        /less
        /coffee


Watchr works with a config file, which basically tells it what to watch for, and what to do if it finds any changes. I placed the file inside the `_src` folder and named it `watchr.rb`

Here's my config file at the moment:

    def compile_less
        %x[lessc less/bootstrap/bootstrap.less ../css/main.css --yui-compress]
    end

    def compile_coffee
        %x[coffee -c -j ../js/app.js coffee/]
    end

    def do_growl(message)
        growlnotify = `which growlnotify`.chomp
      title = "Watchr Message"
      passed = message.include?('0 failures, 0 errors')
      image = passed ? "~/.watchr_images/passed.png" : "~/.watchr_images/failed.png"
      severity = passed ? "-1" : "1"
      options = "-w -n Watchr --image '#{File.expand_path(image)}'"
      options << " -m '#{message}' '#{title}' -p #{severity}"
      system %(#{growlnotify} #{options} &)
    end

    do_growl "Watching folders and waiting for changes .."

    watch('less/*') { |m|
        # Recompile LESS files
        compile_less
        do_growl "LESS Compiled and Compressed!"
    }

    watch('coffee/*') { |m|
        # Recompile Coffeescripts
        compile_coffee
        do_growl "Coffeescripts compiled and concatenated!"
    }

As you can see at the bottom I'm watching the 2 folders seperately, as I want to run different commands for them. For the project I'm working on I'm using Twitter Bootstrap, so rather than compiling all the .less files to seperate .css files I just want to compiled bootstrap.less as that @imports all the things it needs. When it's done with that it yui-compresses the lot and writes the output to `css/main.css`. Pretty cool!

The compile_coffee command does something pretty similar. Whenever a .coffee file in the coffee folder changes it will compile them all and combine the output (notice the `-j` flag) and write it to `js/app.js`.

To get the show on the road, cd to the `_src` folder, and run:

    $ watchr watchr.rb

You may have noticed the `do_growl` function, which doesn't really add value except that it's just cool to get a Growl message whenever it has done it's thing. To get that bit working you have to install ["Growl Notify"][2].

If you're not that interested, or you don't have a Mac with Growl simply remove the function and the do_growl calls from the watch patterns.

I'm sure I could optimize this a bit, and add variables for output folders and options, but for now it's simple, working, and pretty damn cool.

Let me know how you get your watchr set up!

 [1]: https://github.com/mynyml/watchr
 [2]: http://growl.info/extras.php#growlnotify
