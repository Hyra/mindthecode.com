---
title: Writing Browserify modules for your Angular app
subtitle: How to create little re-usable modules 
description: >-
  Following up on my previous post I got a few questions on how to create
  modules for your app. Let me show you.
tags:
  - browserify
  - angular
publishDate: 2014-06-03T00:00:00.000Z
layout: post
header: modules.gif
---

Following up on my previous [Let's Build an angular app with Browserify](/lets-build-an-angularjs-app-with-browserify-and-gulp/) post I got a few questions on how to create modules for your app. Let me show you.

If you haven't already, make sure you've read the [walkthrough](/lets-build-an-angularjs-app-with-browserify-and-gulp/) on how to set up the environment to work with Browserify and Gulp, so you can follow along.

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

Basically, what you do when you `require()` a module, is looking for what the script you require exposes to the outside world through `module.exports`. This is following the [CommonJS](http://en.wikipedia.org/wiki/CommonJS) spec. This allows us to encapsulate functionality privately within our module, and only export the 'public' methods or variables to the outside world.

Now, what does this look like for our Browserify Angular app?

## A Controller module

Let's assume we're using `ui-router` for the awesome stateprovider, and want to specify one of our own controllers through `require()`

{% prism javascript %}
var app = angular.module('myApp', ['uiRouter']);

$stateProvider

  .state('about', {
    views: {
      'contents': {
        controller: require('./controllers/AboutCtrl').inject(app),
        templateUrl: '/views/home.html'
      }
    }
  });
{% endprism %}

What we do here is not that much different from the plain old way, but instead of including a script tag to `controllers/AboutCtrl.js` and using the name, we call `require()` on our module, and call `.injdect(app)` on it.

This works, because our module exports an angular controller object, which it is able to do because we inject our app. Here's what it looks like:

{% prism javascript %}
exports.inject = function(app) {
  app.controller('AboutCtrl', exports.controller);
  return exports.controller;
};

exports.controller = function AboutCtrl($scope) {
  $scope.regularAngular = 'Hello!';
};
{% endprism %}

As you can see, our inject function takes the app, and in turn returns our controller function. Simple, clean and effective.

## Dependency injection

But what if we want to use a dependency. Simply require it and inject it:

{% prism javascript %}
exports.inject = function(app) {
  require('./../services/SomeService').inject(app); // Require the someservice module
  app.controller('AboutCtrl', exports.controller);
  return exports.controller;
};

// Pass the SomeService as parameter
exports.controller = function AboutCtrl($scope, SomeService) {
  // And profit.
  $scope.regularAngular = SomeService.getYourStuff();
};
{% endprism %}

This is how that SomeService would look like. Not much different, but instead of exposing a controller, we return a factory:

{% prism javascript %}
exports.inject = function(app) {
  app.factory('SomeService', exports.factory);
  return exports.factory;
};

// Any extra dependencies can just be passed in
exports.factory = function($http, $cookieStore, $resource) {

  var monkey = 'Strawberry';

  return {
    getYourStuff: function() {
      return monkey;
    }
  }
};
{% endprism %}

And that's how we can write little re-usable modules to use in our Angular App!

I hope the above helps, and if you have any questions feel free to ask.

Happy coding.
