---
title: React Storybook
description: >-
  Recently React Storybook came out. It's a tool to isolate your React
  Components to develop and design them outside of your app. I'll be walking
  through setting it up
publishDate: 2016-04-17T00:00:00.000Z
tags:
  - react
layout: post
---

Recently React [Storybook][1] came out. It's a tool to isolate your React Components to develop and design them outside of your app. In this post I'll be going over how to get it set up.

# Why use it?

What intrigued me about Storybook is the fact you can work on defining and designing your React components in an environment where you don't have to worry about the app itself. In fact, by having them isolated you can make sure they work correctly by themselves and don't rely on the rest of your application.

As a nice side effect, you end up with some sort of "Styleguide" for your components so new members on the team can get familiar with the components without having to sift through the code.

# Setting the scene

Make sure you run with NPM3 following this post as otherwise you might end up with storybook being unable to find its dependencies.

Let's start from scratch by creating a new directory and typing:

{% highlight bash %} $ npm init {% endhighlight %}

This way we end up with a `package.json` that Storybook relies on. In my case it looks like this:

```javascript
{
  "name": "storybook-test",
  "version": "1.0.0",
  "description": "Testing out Storybook!",
  "main": "index.js",
  "scripts": {
  },
  "author": "",
  "license": "ISC"
}
```

Now let's install React:

```bash
$ npm install --save react
```

Next, let's create a component we want to use in Storybook. Create a folder `components` and add a file `card.js` in it containing the following code:

```javascript
import React from 'react';

class Card extends React.Component {

  render() {

    let styles = {
      card: {
        border: '1px solid #FF4422',
        borderRadius: 4,
        backgroundColor: '#FF9988',
      },
      title: {
        color: 'white',
        margin: 0,
        padding: 10,
        fontFamily: 'Helvetica Neue',
      }
    };


    return (
      <div style={styles.card}>
        <h1 style={styles.title}>{this.props.title}</h1>
      </div>
    );
  }
}

module.exports = Card;
```

# Configuring Storybook

Now that we got a base to work with, let's install Storybook and set it up.

First, install Storybook

```bash
$ npm install --save @kadira/storybook
```

Storybook depends on a folder `.storybook` which contains the configuration, so let's create that folder and inside add a `config.js`:

```javascript
import { configure } from '@kadira/storybook';

function loadStories() {
  require('../components/stories/');
}

configure(loadStories, module);
```

From the above you can probably guess the next step, we need to create a folder `stories` inside the `components` folder which will hold our stories. You are free to use any folder you want though.

In `stories`, add a file `card.js` with this code:

```javascript
import React from 'react';
import Card from '../card'; // This is our component
import { storiesOf, action } from '@kadira/storybook';

storiesOf('Card', module)
  .add('with a text', () => (
    <Card title="A little card" />
  ))
```

At the top we import our Card component. Storybook provides a chainable method `storiesOf` after which you can describe all your possible 'states'. In the above example we only have one, but we'll add more in a second.

Now, in `.storybook/config.js` we declared our stories can be loaded from `components/stories`, so in order to be able to do that we need to create an `index.js` file which will import all the stories we want to show up in storybook, so create it and add the following inside:

```javascript
import './card';
```

Alternatively you can specify the story files from the storybook config file, but this feels a bit more logical.

# Running storybook

We're almost there! In order to run Storybook we need to add a script to our `package.json`. Alter the file so it has the storybook script in there:

```javascript
...
"scripts": {
  "storybook": "start-storybook -p 9001"
},
...
```

Now we can go to the command line and run

```bash
$ npm run storybook
```

and if all goes well we can navigate to our very own [Storybook](http://localhost:9001) and see our component!

# Adding more stories

To illustrate how storybook works, let's add another story for our card:

```javascript
import React from 'react';
import Card from '../card'; // This is our component
import { storiesOf, action } from '@kadira/storybook';

storiesOf('Card', module)
  .add('with a text', () => (
    <Card title="A little card" />
  ))
  .add('with a specific background', () => (
    <Card title="A little card" background={ '#550011' } />
  ))
```

We specified a story that states we can have a button with a specific background. Let's modify the render method of our component to make that possible:

```javascript
...
render() {

  let styles = {
    card: {
      border: '1px solid #FF4422',
      borderRadius: 4,
      backgroundColor: '#FF9988',
    },
    title: {
      color: 'white',
      margin: 0,
      padding: 10,
      fontFamily: 'Helvetica Neue',
    }
  };

  if(this.props.background) {
    styles.card.background = this.props.background;
  }

  return (
    <div style={styles.card}>
      <h1 style={styles.title}>{this.props.title}</h1>
    </div>
  );
}
...
```

Refresh your storybook, and you should see the second story show up and when you click it the button is slightly darker (unless you felt adventurous and made your own modifications of course!)

# Conclusion

I think [Storybook][1] is a perfect way to define the possible 'states' of your component and offers a nice isolated environment where a developer and designer can go over all the components to make sure they look the way they should, without having to interact with the actual app to force all different states to check them.

I put the example code of this post up on Github so if you were somehow stuck you can check that out:

<https://github.com/Hyra/react-storybook-demo>

If you have any questions or comments, use Disqus below or find me on Twitter.

Happy coding!

[1]: https://github.com/kadirahq/react-storybook
