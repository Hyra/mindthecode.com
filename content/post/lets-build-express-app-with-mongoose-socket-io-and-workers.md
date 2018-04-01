---
title: "Let's build: an Express app with Mongoose, Socket.IO and Redis workers"
subtitle: Making it all tick together.
description: >-
  Stop me if this sounds familiar. You set out to create your next new project, and after a few hours you still find yourself setting up the boilerplate code.
tags:
  - javascript
  - express
  - socketio
  - redis
  - mongo
layout: post
header: procrastinating.gif
date: 2017-11-07
references:
draft: true
---

Boilerplate apps are great. They let you get your next project up and running quickly, and usually provide some form of structure you can follow.

They can also, however, be a massive time-sink. We developers are curious by nature, and tend to have this thing where we want to know exactly how things run under the hood 🙈 In addition, boilerplates can be too minimalistic for your needs, or too much bloat. This means you either spend time adding base-features, or scraping off the excess things you don't need.

This process is not a bad thing in itself, obviously, but it can easily lead to procrastination. Time you could probably better spend building that awesome feature, instead!

## Should we use boilerplates?

YES! I'm not saying we shouldn't use boilerplate. Quite the opposite, actually. Building a project from scratch will usually be far more time consuming than using a boilerplate. The trick is using the **right** boilerplate for your project. I really believe the boilerplate you should use is the one you build yourself. Building a boilerplate not only teaches you a **ton**, it also leaves you with a piece of base code you know inside out and can use to start working on that next project.

And of course you don't have to start from scratch. You can pick any boilerplate that sort of works for you, and then customize it so it works for you. Or your team.

## But not all projects are the same!

Agreed. Even more so, not every *environment* is the same. Or project team, for that matter. For instance, you might use a completely different stack when you are working on your pet side-projects than what you use at the office. Personally, I work with about 4 boilerplate apps, depending on the project, the people I work with and sometimes the constraints set by the client. For example:

* A VueJS Single Page App
* An API only Express application
* A Static Site Generator (Hexo) for blogs
* etc.

The idea is that you standardize as much as possible, but don't constrain yourself too much. Creating every project based on a certain 'base' you are familiar with makes sure you can get up and running quickly.

## Keeping up to date

Of course, you should keep your boilerplate apps up to date. Make sure to check your dependencies are up to date every now and then, check it still works, and see if there's any upgrades. Over time you will know exactly what works, and what doesn't, so when that new library comes along you know exactly where to fit it in. But, don't do this religously, else we end up tinkering on Boilerplate apps rather than projects that will let you take over the world 🦄



 They provide you with a kick-start so you can start developing your project straight away. In reality though, most developers find themselves spending hours and hours getting familiar with how the boilerplate code works and what makes it tick. This is because developers are curious by nature, and have a thing where they want to know exactly how things run under the hood.

This is very healthy.

This is also very time-consuming

But I often find myself setting out to create a new project only to find myself, hours later, fiddling with boilerplate code and organizing the base. Now, there is a lot of "starter kit" apps out there to battle just this, but I find them to either be too much bloat, or too minimalistic. In the first case I spend my time scraping off all the things I don't need or want, and with the latter I end up spending my time installing and configuring additional packages or features.

Don't worry, this isn't a post about the gazillionth starter kit and how it solves everyones use cases. Instead, I want to encourage every developer to make their own boilerplate for your own (side-)projects. Not only does it teach you a **ton**, it also leaves you with a piece of base code you know inside out and can use to start working on that next project, rather than procrastinating.

> I want to encourage every developer to make their own boilerplate for your own (side-)projects

So what are we going to do? I'll walk you through how I built my Express boilerplate app.

## run express generator for default code
express --view=pug bah

DEBUG=bah:* npm start

# yarn install
yarn start

# Make sure it all works
(node bin/www)

# Add .gitignore (commit early and often)

# Add mongo and redis through docker-compose
+ docker-compose.yml

# Create Makefile to run multiple things
- modify package.json, add dev with 'nodemon ./bin/www'
- yarn add nodemon
+ nodemon.json:

    {
        "verbose": true,
        "ignore": ["node_modules/*", "public/*"],
        "delay": "1666"
    }

+ Makefile
    
    run:
        docker-compose down && docker-compose up -d
        concurrently --kill-others --prefix "[{name}]" --names "APP" -c "magenta" "yarn dev"

Now runs mongo, redis and express concurrently

# Add .env
❯ yarn add dotenv

# Implement mongoose
+ models/index.js
+ models/user.js
❯ yarn add mongoose-slug-hero mongoose bcryptjs slug

add MONGODB_URI to .env

# Add a worker process (even if not used, good to test things out)
+ worker.js
Add it to Makefile

# Add Kue
yarn add kue
Add REDIS_URL to .env
Example in worker

    queue.createJob('testjob', {
    })
    .removeOnComplete(true)
    .attempts(3)
    .ttl(10000)
    .save(function(err) {
        console.log(`Added job`)
    })

    var kue = require('kue'),
        queue = kue.createQueue({
            redis: process.env.REDIS_URL
        })

    queue.process('testjob', function(job, done) {
        console.log(job.id)
        done()
    });

# Add Socket.io
❯ yarn add socket.io
app.js

    app.io = require("socket.io")();
    require("./sockets")(app.io);

bin/www
    
    app.io.attach(server); 

worker.js
    
    sample emit

layout.pug

    script(src='/socket.io/socket.io.js')

+ sockets.js

Add socket script to app.js

# Add Vue (refer to post)
+ webpack.config.js
+ public/javascripts/main.js
+ public/javascripts/components
+ public/javascripts/components/example.vue
-> add to main.js
-> add #app to layout.pug
-> add script to layout.pug

    script(src="/javascripts/bundle.js")
-> add to package.json

    "dev": "watchify -vd -p browserify-hmr -t vueify -e public/javascripts/main.js -o public/javascripts/bundle.js"
-> add packages
❯ yarn add vue watchify vueify browserify-hmr node-sass babel-loader babel-core babel-preset-es2015 babel-plugin-transform-runtime sass-loader

Update Makefile

# Deploy to Heroku
heroku addons:create heroku-redis:hobby-dev
heroku addons:create mongolab:sandbox

heroku config:set NPM_CONFIG_PRODUCTION=false

build script in package.json

Procfile for worker

# Bits and bobs

+ nodemon.json


# Production mode

cross-env
envify
script build
    
    "build": "cross-env NODE_ENV='production' browserify -g envify -t vueify -e public/javascripts/main.js -o public/javascripts/bundle.js"