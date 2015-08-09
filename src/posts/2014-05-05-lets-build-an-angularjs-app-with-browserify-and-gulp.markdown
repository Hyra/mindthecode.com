---
title: "Lets build: An AngularJS app with Browserify and Gulp"
description: Today I want to show a generic workflow and setup I have used a lot lately when working on building apps with Angular. It uses Gulp as a CI system and Browserify to minimize code clutter and maximize awesomeness.
tags: angular, browserify, gulp
publishDate: 2014-05-05
template: post.jade
header: letsbuild.gif
---

Today I want to show a generic workflow and setup I have used a lot lately when working on building apps with Angular. It uses Gulp as a CI system and Browserify to minimize code clutter and maximize awesomeness. So let's jump in.

## Update 21 october 2014 - Frickle

As with most things, boilerplates evolve. I decided to expand the boilerplate we're building below with a backend for the API side, as well as cleaning up some things based on new findings and updated modules. To find out more about that have a look at [Frickle](http://github.com/Hyra/Frickle).

## Let's get started!

Instead of starting from a cloned code repository let's build our setup together. From scratch. This way you know what each piece does, and allows you to tweak it to your liking. Of course, the final product can be found [here](https://github.com/Hyra/angular-gulp-browserify-livereload-boilerplate) at Github, but it might be better to use it as a reference rather than a starting point.

## Folder structure

When building a web application I tend to have an `app` folder for the original source files, and a `dist` folder which contains all the processed files and will serve as the root directory for the webserver. So let's create the following folder structure:

    app
      index.html
      images            // Visual assets
      scripts           // Your javascript
         controllers
         directives
         services
         main.js        // Single main entry point
      styles            // SCSS or LESS or CSS files
      views             // Templates
    dist                // The target and 'www' folder
    Gulpfile.js         // Gulp instructions file
    package.json        // Package file with installation references

## Getting some modules

To get everything up and running, let's first get some NPM modules we want to work with. Depending on your personal preferences you might want to replace some of them or add other ones to suit your specific needs. The modules I usually install are:

### Gulp

This is the workhorse of our setup.

### Angular

We will install Angular through NPM so we can require it with browserify.

### Browserify

Browserify allows us to utilize the `require()` syntax we love in NodeJS in our front-end. Can you spell u.n.i.c.o.r.n.s ?

### gulp-browserify

This allows us to run Browserify from within our Gulpfile.

### gulp-clean

Allows us to clean (empty) a folder or file, which is nice to make sure we don't end up with any artifacts.

### gulp-concat

When using browserify for our code we want to concat it to a single bundled javascript file. This plugin allows us to do just that.

### gulp-jshint

We all love syntactically correct code, don't we? This plugin checks your javascript files and tells you when something is wrong. Or not pretty enough.

### gulp-util

General gulp utilities, such as colour in your `gutil.log()` calls, and handy methods for common operations such as `replaceExtension()` and `noop()`.

### gulp-embedlr, gulp-livereload, tiny-lr, connect-livereload, express

These I use so I can run a local webserver and support live reloading of the app as we save files.

And this will do fine for now. So! Let's install all these babies, and save them to our `package.json` by adding `--save-dev`

```bash
$ npm install gulp browserify gulp-browserify gulp-clean gulp-concat gulp-jshint gulp-util gulp-embedlr gulp-livereload tiny-lr connect-livereload express --save-dev
```

## Configuring our Gulpfile

Now we have all the components in place it's time to write our Gulpfile. Let's start small and expand as we go along.

First, let's make sure we can `watch` our javascript files, and as they change, run them through JSHint and have Browserify bundle the code into a single file:

    var gulp = require('gulp'),
        gutil = require('gulp-util'),
        jshint = require('gulp-jshint'),
        browserify = require('gulp-browserify'),
        concat = require('gulp-concat'),
        clean = require('gulp-clean');

    // JSHint task
    gulp.task('lint', function() {
      gulp.src('./app/scripts/*.js')
      .pipe(jshint())
      // You can look into pretty reporters as well, but that's another story
      .pipe(jshint.reporter('default'));
    });

    // Browserify task
    gulp.task('browserify', function() {
      // Single point of entry (make sure not to src ALL your files, browserify will figure it out for you)
      gulp.src(['app/scripts/main.js'])
      .pipe(browserify({
        insertGlobals: true,
        debug: true
      }))
      // Bundle to a single file
      .pipe(concat('bundle.js'))
      // Output it to our dist folder
      .pipe(gulp.dest('dist/js'));
    });

    gulp.task('watch', ['lint'], function() {
      // Watch our scripts
      gulp.watch(['app/scripts/*.js', 'app/scripts/**/*.js'],[
        'lint',
        'browserify'
      ]);
    });

So far so good! Whenever we change code in our javascript files a fresh bundle.js is created for us to use in our site.

## Set up our index.html file

Let's create a simple `index.html` file so we can see our work in the browser. Open up `index.html` and add something like the following:

```html
<!doctype html>
<html lang="en" ng-app="myApp">
<head>
  <title>My Awesome App</title>
</head>
<body ng-controller='WelcomeCtrl'>
  <h1>My Awesome App</h1>
  <p>{{testVar}}</p>
  <script src="/js/bundle.js"></script>
</body>
</html>
```

The above should look familiar. We include our bundle.js file we created earlier at the bottom, initiate a ng-app by adding the directive to the html tag, attach a controller to the body and have a simple variable in the body so we can see if things work. Which at this point is a NO. Let's fix that.

First of all, we want this index.html file to be added to our `dist` folder so we can actually serve it. We can do this by adding an extra task:

    // Views task
    gulp.task('views', function() {
      // Get our index.html
      gulp.src('app/index.html')
      // And put it in the dist folder
      .pipe(gulp.dest('dist/'));

      // Any other view files from app/views
      gulp.src('./app/views/**/*')
      // Will be put in the dist/views folder
      .pipe(gulp.dest('dist/views/'));
    });

We can also set up another watcher in the watch task to pick up any changes as we build:

    gulp.watch(['app/index.html', 'app/views/**/*.html'], [
      'views'
    ]);

At the moment we pretty much have a working app. We just can't see it. Let's change this by adding a self contained webserver, straight from our Gulp.

## Webserver with live reload

First of all, we need to add some modules to our Gulpfile that allows us to run a mini express server.

    var embedlr = require('gulp-embedlr'),
        refresh = require('gulp-livereload'),
        lrserver = require('tiny-lr')(),
        express = require('express'),
        livereload = require('connect-livereload'),
        livereloadport = 35729,
        serverport = 5000;

    // Set up an express server (but not starting it yet)
    var server = express();
    // Add live reload
    server.use(livereload({port: livereloadport}));
    // Use our 'dist' folder as rootfolder
    server.use(express.static('./dist'));
    // Because I like HTML5 pushstate .. this redirects everything back to our index.html
    server.all('/*', function(req, res) {
    	res.sendfile('index.html', { root: 'dist' });
    });

Next, let's start the server. You can do this from any task, but let's create a `dev` task for the fun of it.

    // Dev task
    gulp.task('dev', function() {
      // Start webserver
      server.listen(serverport);
      // Start live reload
      lrserver.listen(livereloadport);
      // Run the watch task, to keep taps on changes
      gulp.run('watch');
    });

Now, when you run `gulp dev` it will kickstart our internal webserver with our `dist` folder as root. You can verify everything is working by navigating to http://localhost:5000

If all is well you should see the `index.html` show up. Whenever you change a file however, the changes won't automatically show up in the browser. This is because we have to manually invoke the server refresh from within our task. Let's modify our `views` task to automatically refresh the browser after it has done its work:

    gulp.task('views', function() {
      gulp.src('./app/index.html')
      .pipe(gulp.dest('dist/'));

      gulp.src('./app/views/**/*')
      .pipe(gulp.dest('dist/views/'))
      .pipe(refresh(lrserver)); // Tell the lrserver to refresh
    });

Now, whenever you change a view file, the server will reload. Of course, you can do this whenever you want. So feel free to add it in the `browserify` task as well.

## Add some Angular

We are getting somewhere. All that's missing is some actual Angular code. So let's add some. Open up the `main.js` file and put in the following:

    'use strict';

    var angular = require('angular'); // That's right! We can just require angular as if we were in node

    var app = angular.module('myApp', []);

    app.controller('HelloCtrl', function($scope) {
      $scope.test = 'Test varretjes';
    });

In main.js we can now use Node's `require()` way to include modules we want. This is not limited to our own code, we can use most of the ~50k published modules on npmjs.org. When we run `gulp browserify` Browserify will figure out what code to pull in, and will bundle it in our `bundle.js`. Good stuff.

Of course, the controller code should move to a file of its own in the controllers directory so we can actually use the `require` technique. So let's do just that.

Create a new file `controllers/WelcomeCtrl.js` and add in the following:

    'use strict';

    var WelcomeCtrl = function($scope) {
      $scope.testVar = 'We are up and running from a required module!';
    };

    module.exports = WelcomeCtrl;

Notice we use `module.exports` to expose (parts of) our code, as you do with modules. This way we can `require` them from our `main.js` file and use it as a module. Let's change `main.js` to use our fresh module:

    'use strict';

    var angular = require('angular'); // That's right! We can just require angular as if we were in node

    var WelcomeCtrl = require('./controllers/WelcomeCtrl'); // We can use our WelcomeCtrl.js as a module. Rainbows.

    var app = angular.module('myApp', []);
    app.controller('WelcomeCtrl', ['$scope', WelcomeCtrl]);

This is obviously a very bare example, but you can see how using simple `require` calls will save a lot of script tags in your index.html, and having your files behave as modules helps you write re-usable code.

## JSHint.rc

You might have noticed `gulp lint` gives us some errors. That's because it needs some guidance, as it doesn't know about our `require` and preferences. Let's add a file called `.jshintrc` and add in the following configuration:

    {
      "node": true,
      "browser": true,
      "esnext": true,
      "bitwise": true,
      "camelcase": true,
      "curly": true,
      "eqeqeq": true,
      "immed": true,
      "indent": 2,
      "latedef": true,
      "newcap": true,
      "noarg": true,
      "quotmark": "single",
      "regexp": true,
      "undef": true,
      "unused": true,
      "strict": true,
      "trailing": true,
      "smarttabs": true
    }

You may or may not agree with any of these settings, so feel free to tweak them.

## SASS Support

You may have a CSS pre-processor of choice, so let's add support for this. I usually go with SASS, but of course this is adaptable to your liking. Let's install a new module named `gulp-sass` and include it in our Gulpfile.

```bash
$ npm install gulp-sass gulp-autoprefixer --save-dev
```

    var sass = require('gulp-sass');
    // Not necessary, but I like this one, it automatically adds prefixes for all browsers
    var autoprefixer = require('gulp-autoprefixer');

Next, let's write a task for it:

    // Styles task
    gulp.task('styles', function() {
      gulp.src('app/styles/*.scss')
      // The onerror handler prevents Gulp from crashing when you make a mistake in your SASS
      .pipe(sass({onError: function(e) { console.log(e); } }))
      // Optionally add autoprefixer
      .pipe(autoprefixer("last 2 versions", "> 1%", "ie 8"))
      // These last two should look familiar now :)
      .pipe(gulp.dest('dist/css/'))
      .pipe(refresh(lrserver));
    });

And add another watcher.

    gulp.watch(['app/styles/**/*.scss'], [
      'styles'
    ]);

Now, whenever you make changes to your SASS files it will compile it to CSS and live-reload our webserver. Good times.

## Wrapping up

We've done quite a lot. We have set up a webserver, added Gulp to automate all our tasks, added live reloading for easy developing, sass processing, and added support for Browserify so we can script in style.

I created a repository with the above so you can check the finished project, which you can find [here](https://github.com/Hyra/angular-gulp-browserify-livereload-boilerplate).

I hope the above was of some help, and if you have any questions feel free to find me on [Twitter](http://twitter.com/stefvdham), or leave a comment below.

Happy coding.
