---
title: How to use environment variables in your Angular application
subtitle: Handling and managing variables in the front-end
description: I will explain how to use environment variables in your Angular app
tags:
  - angular
publishDate: 2013-12-29T00:00:00.000Z
layout: post
header: environment.gif
---

If you develop a website that uses multiple environments such as **development**, **staging** and **production** you probably have a configuration file of sorts to handle things like database settings, mail server credentials, and so on for your backend system.

But how do you handle such variables in the front-end? Specifically, in an AngularJS App?

For instance, you might have a seperate API you're talking to for your content, which has a different location locally, than on your production server. Or you might want to do some debugging or verbose output, based on what environment you're on.

In this post I'll show you how to set this up automagically using Grunt and ngConstant.

## UPDATE

[Malte](http://werk85.de/) was so kind as to provide an updated configuration for the _ngconstant 0.5.0_ version. The example code in the post has been updated accordingly.

## The ingredients

### Grunt

I'll assume you're familiar with [Grunt](http://gruntjs.com/) and have set it up to aid your workflow. If not, there's plenty of tutorials out there to get this going.

### grunt-ng-constant

This Grunt plugin takes care of the dynamic generation of your constants. Grab it [here](https://github.com/werk85/grunt-ng-constant), or simply install it by doing:

{% prism javascript %}
npm install grunt-ng-constant --save-dev
{% endprism %}

## Automatically write your config.js file

Now that you have all you need, let's set it up! Open up your `Gruntfile.js`, and inside the `grunt.initConfig` section add the following:

{% prism javascript %}
ngconstant: {
  // Options for all targets
  options: {
    space: '  ',
    wrap: '"use strict";\n\n {\%= __ngModule %}',
    name: 'config',
  },
  // Environment targets
  development: {
    options: {
      dest: '<%= yeoman.app %>/scripts/config.js'
    },
    constants: {
      ENV: {
        name: 'development',
        apiEndpoint: 'http://your-development.api.endpoint:3000'
      }
    }
  },
  production: {
    options: {
      dest: '<%= yeoman.dist %>/scripts/config.js'
    },
    constants: {
      ENV: {
        name: 'production',
        apiEndpoint: 'http://api.livesite.com'
      }
    }
  }
},
{% endprism %}

This tells Grunt about your environments. Each target is told where to write the config file to, and inside `constants` you define your environmental variables you wish to use in your Angular App.

<!-- Rectangle Ad -->
<center>
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-0534492338431642"
     data-ad-slot="3199566305"></ins>
</center>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

Next up, we need to tell Grunt when to write this config file. Depending on your Gruntfile you will probably have a section that tells it to run a local server so you can develop your site. Mine usually looks like this:

{% prism javascript %}
grunt.registerTask('serve', function (target) {
  if (target === 'dist') {
    return grunt.task.run(['build', 'connect:dist:keepalive']);
  }

  grunt.task.run([
    'clean:server',
    'ngconstant:development', // ADD THIS
    'bower-install',
    'concurrent:server',
    'autoprefixer',
    'connect:livereload',
    'watch'
  ]);
});
{% endprism %}

Here we tell Grunt to build the ng-constants for the **development** area. So whenever you boot up the local environment with `grunt serve`, it will write out the config file for the development target.

Likewise, we want to do the same for our production environment. Best place to do that is in our `grunt build` task:

{% prism javascript %}
grunt.registerTask('build', [
  'clean:dist',
  'ngconstant:production', // ADD THIS
  'bower-install',
  .. // other build tasks
]);
{% endprism %}

When Grunt runs the task, a config file is generated, with our constants:

{% prism javascript %}
'use strict';

angular.module('config', [])

.constant('ENV', {
  'name': 'development',
  'apiEndpoint': 'http://your-development.api.endpoint:3000'
});
{% endprism %}

## Using the config file in your App

So, now that we have a dynamic `config.js` file based on where we are, let's see how we can use it in our AngularJS App.

First thing to do is add the config file to our `index.html`

{% prism html %}
<script src="/scripts/config.js" />
{% endprism %}

Next, we can inject it into our app:

{% prism javascript %}
var app = angular.module('myApp', [ 'config' ]);
{% endprism %}

And now, since config.js exposes an object `ENV` which is injected, whenever we need our ENV variables we can simply use them in our controllers by doing:

{% prism javascript %}
angular.module('myApp')
  .controller('MainCtrl', function ($scope, $http, ENV) { // ENV is injected

  $scope.login = function() {

    $http.post(
      ENV.apiEndPoint, // Our environmental var :)
      $scope.yourData
    ).success(function() {
      console.log('Cows');
    });

  };

});
{% endprism %}

And there you have it. Environmental variables in your front-end. It might look like a lot of work, but once you've set it up it's easy to extend the variables and duplicate environments to match your needs.

Happy coding.
