{{{
  "title": "Installing PHPUnit manually for CakePHP 2.0",
  "date": "2011-11-11",
  "categories": ["PHP", "GZip"]
}}}

I was trying to get into Unit Testing a few months ago. It was a steep learning curve and eventually I gave myself a non-excuse and decided to wait for Cake 2.0 as that would have PHPUnit and it "wouldn't make sense to learn SimpleTest" at that time.

I intend to keep that promise and have been trying to get into Unit Testing for real this time. The first thing was also the most annoying so far: installing the *(&#(*&. After completely messing up my local PEAR environment I gave up on the "official way" and wrote a `PHPUnit Installer Shell` to install PHPUnit along with the Cake site.

<!--more-->

## PHPUnit locally?

Yes! I'm a fan of self-contained systems. Sure, installing PHPUnit through PEAR *should* provide a systemwide tool, but when you're working on multiple workstations and deploy to different hosting setups its just nice to know you have everything within reach. Besides, my MAMP setup on OSX Lion didn't play nice with PEAR **at all** so enough excuses to write an installer shell.

## What it does

It's quite simple really, it downloads all the files and folders that PHPUnit needs, makes them into a nice package and moves them into the `app` folder, ready for you to play with!

## How do I get it

I just pushed it to Github: [Get the installer Shell here](https://github.com/Hyra/PHPUnit-Cake2)

The README there provides you with the rest of the information.

I'll post some updates on my journey when I can, meanwhile: If you have any optimialisations, ideas on Unit Testing in general or some good pointers .. let me know!

[1]: https://github.com/Hyra/PHPUnit-Cake2 "CakePHP 2.0 Installer Shell"
