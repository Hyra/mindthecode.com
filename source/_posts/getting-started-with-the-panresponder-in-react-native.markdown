---
layout: post
title: Getting started with the PanResponder in React Native
subtitle: Follow along as we tackle the madness that is the PanResponder.
description: >-
  Inside React Native you can use the PanResponder to recognize multi-touch
  gestures as well as swipes and other touches that make native apps feel snappy
  and intuitive. But getting it up and running can feel daunting and borderline
  black magic. In this post I'll try and guide you through the process,
  hopefully demystifying it a bit and get you on track to awesomeness.
tags:
  - react
  - react-native
  - javascript
  - panresponder
  - ios
  - iphone
  - tap
<!-- teaser: modules.gif -->
date: 2016-04-20
---

Inside React Native you can use the PanResponder to recognize multi-touch gestures as well as swipes and other touches that make native apps feel snappy and intuitive. But getting it up and running can feel daunting and borderline black magic. In this post I'll try and guide you through the process, hopefully demystifying it a bit and get you on track to awesomeness.


## What we will be making

Obviously we'll be wanting to focus on the PanResponder itself so UI wise this will be pretty barebones. We'll have an image on screen we can drag. When we release it it will bounce back to its original position. As a bonus, while we press down on the image it will scale up.

<center>
![PanResponder Demo](/images/panresponder_demo.gif)
</center>

## Setting the stage

I'll be assuming you're somewhat familiar with setting up a fresh React Native project. If not, the guys at Facebook have done an excellent job explaining the steps [right here](http://facebook.github.io/react-native/docs/getting-started.html#content).

Let's start with a new project. I'll call it panresponder-demo for simplicity sake and lack of a name that rhymes with unicorns.

``` bash
$ react-native init panresponder_demo
```

First up, let's add an image to the project that will act as your drag and drop target.

Create a directory `assets` to the panresponder_demo folder and insert the image you want to use in there. If you don't have one, you can use [this one](/images/panresponder-target.png).

Let's get our image on the screen so we can continue on to the cool part.

<!-- Rectangle Ad -->
<!-- <center>
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-0534492338431642"
     data-ad-slot="3199566305"></ins>
</center>
<script>(adsbygoogle = window.adsbygoogle || []).push({});</script> -->

Open up `index.ios.js` and add the `Image` component at the top:

``` javascript
import React, {
  AppRegistry,
  Component,
  StyleSheet,
  Text,
  View,
  Image // we want to use an image
} from 'react-native';
```

Now replace the default app content with our Image so alter the `render()` method

``` javascript
render() {
  return (
    <View style={styles.container}>
      <Image source={require('./assets/panresponder.png')} />
    </View>
  );
}
```

When you run the app now you should see the image in the center of the screen, waiting for you to do something more exciting. So let's get to it.

<center>
![Panresponder 01](/images/panresponder_01.png)
</center>

## Adding the PanResponder

Let's get to the more interesting part. Adding the PanResponder system.

At the top, import `PanResponder` so we can use it. While we're at it, we'll also add `Animated` which allows us to use Animated values, which will come in handy for our animation and calculations.

``` javascript
import React, {
  AppRegistry,
  Component,
  StyleSheet,
  Text,
  View,
  Image, // we want to use an image
  PanResponder, // we want to bring in the PanResponder system
  Animated // we wil be using animated value
} from 'react-native';
```

PanResponder basically consists of a couple of event-driven methods that you can implement. Once you've defined what you want it to behave like you attach it to a view, which will then propagate all the events (gestures) to the methods you hooked up.

To illustrate it in a simple way, let's implement the `componentWillMount()` method and set up a basic PanResponder instance:

``` javascript
componentWillMount() {
  this._panResponder = PanResponder.create({
    onMoveShouldSetResponderCapture: () => true,
    onMoveShouldSetPanResponderCapture: () => true,

    onPanResponderGrant: (e, gestureState) => {
    },

    onPanResponderMove: Animated.event([
    ]),

    onPanResponderRelease: (e, {vx, vy}) => {
    }
  });
}

render() {
  return (
    <View style={styles.container}>
      <Animated.View {...this._panResponder.panHandlers}>
        <Image source={require('./assets/panresponder.png')} />
      </Animated.View>
    </View>
  );
}
```

**Whoa**, lots going on here. Let's break it down.

`onMoveShouldSetResponderCapture` tells the OS we want to allow movement of the view we'll attach this panresponder to. `onMoveShouldSetPanResponderCapture` does the same, but for dragging, which we want to be able to do.

Next up we got 3 methods that will be called `onPanResponderGrant` gets invoked when we got access to the movement of the element. This is a perfect spot to set some initial values.

`onPanResponderMove` gets invoked when we move the element, which we can use to calculate the next value for the object

`onPanResponderRelease` is invoked when we release the view. In a minute we'll use this to make the image animated back to its original position

Last up, we add the panresponder to an `Animated.View` which we use to wrap the `Image` component in so it will obey our panresponding demands.

## Make it draggable

Let's implement the first 2 methods to be able to drag the image around the screen.

In order to keep track of where the image is on the screen we'll want to keep a record of its position somewhere. This is the perfect job for a components `state`, so let's add this:

``` javascript
constructor(props) {
  super(props);

  this.state = {
    pan: new Animated.ValueXY()
  };
}
```

Next, let's update the `panHandler` implementation:

``` javascript
componentWillMount() {
  this._panResponder = PanResponder.create({
    onMoveShouldSetResponderCapture: () => true,
    onMoveShouldSetPanResponderCapture: () => true,

    // Initially, set the value of x and y to 0 (the center of the screen)
    onPanResponderGrant: (e, gestureState) => {
      this.state.pan.setValue({x: 0, y: 0});
    },

    // When we drag/pan the object, set the delate to the states pan position
    onPanResponderMove: Animated.event([
      null, {dx: this.state.pan.x, dy: this.state.pan.y},
    ]),

    onPanResponderRelease: (e, {vx, vy}) => {
    }
  });
}
```

Basically, upon dragging we updat the states pan value, and when we move, we set the dx/dy to the value from the pan.

Now that we have our values, we can use this in our `render()` method, which gets called constantly as we're dragging, so we can calculate the position of our image in there:

``` javascript
render() {
  // Destructure the value of pan from the state
  let { pan } = this.state;

  // Calculate the x and y transform from the pan value
  let [translateX, translateY] = [pan.x, pan.y];

  // Calculate the transform property and set it as a value for our style which we add below to the Animated.View component
  let imageStyle = {transform: [{translateX}, {translateY}]};

  return (
    <View style={styles.container}>
      <Animated.View style={imageStyle} {...this._panResponder.panHandlers}>
        <Image source={require('./assets/panresponder.png')} />
      </Animated.View>
    </View>
  );
}
```

## Getting there!

We're getting somewhere. When you run the app now you will be able to drag the image around the screen! However, when you do this for a second time you will notice it starts from the middle of the screen again instead of following up where you left it.

Let's fix that.

Fortunately, it's quite simple. We need to alter the initial value in `onPanResponderGrant` to take in account the correct offset (we dragged it off center):

``` javascript
onPanResponderGrant: (e, gestureState) => {
  // Set the initial value to the current state
  this.state.pan.setOffset({x: this.state.pan.x._value, y: this.state.pan.y._value});
  this.state.pan.setValue({x: 0, y: 0});
},
```

If you were to run the code again you will notice a second drag and drop works perfectly, but every time after that the image will jump erratically. This has to do with the way the offset is calculated. We actually need to flatten this once you let go of the image. This can be done in our 3rd and last method:

``` javascript
onPanResponderRelease: (e, {vx, vy}) => {
  // Flatten the offset to avoid erratic behavior
  this.state.pan.flattenOffset();
}
```

## Scaling up and down

Last but not least, lets make the image change in size while we're dragging. First we'll add a `scale` property to our state so we can use this in our style and influence its value in the PanResponder

``` javascript
this.state = {
  pan: new Animated.ValueXY(),
  scale: new Animated.Value(1)
};
```

We'll use the value of this in our style inside the render method

``` javascript
...
let rotate = '0deg';

// Calculate the transform property and set it as a value for our style which we add below to the Animated.View component
let imageStyle = {transform: [{translateX}, {translateY}, {rotate}, {scale}]};
...
```

With this in place all that's left to do is influence the value of `scale` in the PanResponder implementation. When we start dragging the `onPanResponderGrant` method is invoked, so we can animate the value

``` javascript
onPanResponderGrant: (e, gestureState) => {
  // Set the initial value to the current state
  this.state.pan.setOffset({x: this.state.pan.x._value, y: this.state.pan.y._value});
  this.state.pan.setValue({x: 0, y: 0});
  Animated.spring(
    this.state.scale,
    { toValue: 1.1, friction: 3 }
  ).start();
},
```

and when we release it we'll animate it back

``` javascript
onPanResponderRelease: (e, {vx, vy}) => {
  // Flatten the offset to avoid erratic behavior
  this.state.pan.flattenOffset();
  Animated.spring(
    this.state.scale,
    { toValue: 1, friction: 3 }
  ).start();
}
```

## Conclusion

And that's it! We got an image we can drag around, and it will give a visual indication we're doing so (besides following our finger).

The resulting code can be found [here on Github](https://github.com/Hyra/panresponder_demo), in case you didn't follow along or want to review it.

As always, should you have any questions you can find me on Twitter.

Happy coding!
