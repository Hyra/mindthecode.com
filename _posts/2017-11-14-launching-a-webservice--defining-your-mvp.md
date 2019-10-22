---
title: "Launching a webservice: defining your MVP"
subtitle: Decide what to build. And what not to build
description: >-
  When you have an idea for a webapp it's easy to get lost into neat little features. But do you need all of them straight away? How do you define your Minimal Viable Product
tags:
  - mvp
  - saas
  - webservice
  - startup
layout: post
header: procrastinating.gif
image: fb_share.png
date: 2017-11-14
references:
---

{% include carbon.html %}

When you have an idea for a webservice it's easy to get lost into coding a lot of neat little features. But do you need all of them straight away? More often than not these features will cost you a lot of time to develop, while they might not even be the features your customer want.

Wikipedia says:

> A Minimum Viable Product (MVP) is a product with just enough features to satisfy early customers, and to provide feedback for future product development.

But how do you decide which features make it into your Minimal Viable Product? As I'm (re-)launching a webservice at the moment I figured it would be good to use it as an example.

## A little backstory.

For illustration purposes, I'll be using one of my own webservices and use it to go through the process of defining the MVP for it. I recently launched [Wulfdeck.com](https://wulfdeck.com), a service that cralws your website and finds all pages. It then takes them through the Google Pagespeed API and finds the pagespeed for each page. Once scanned you can see what needs to be improved to increase the score. As a bonus, it will tell you exactly how much your score will improve per individual improvement, so you don't waste time fixing things that are not be worth the time/tech investment.

At the moment it uses a Freemium model and a monthly Pro subscription. I've decided that marketing this SaaS will take too much of my time, let alone maintaining it for paying customers (_which it doesn't have yet_). So, I will be dropping the account system altogether and .. make the service free for everyone! In addition, it allows me to use it as a real life use case on this blog to illustrate various topics.

**A win-win situation 🦄**

## Different types of MVP's

The internet will argue there's different kinds of MVP's. The most barebones variation is one where you have a landingpage and 'pretend' to have a product and then ask people to sign up by email to be informed once it launches. This way you can quickly **validate** whether it's even worth the actual work of building your SaaS before you write a single line of code for it.

Another version is where you already validated the idea, by talking to people, and want to get your functional product out there. This is the variation we will be discussing here.

## Setting a goal

Every product should have a goal. What problem is your SaaS trying to solve? Ideally this is one line clearly stating what your webservice is all about. For our example, Wulfdeck, this could be the following:

> Goal: Give user insight in the Pagespeed of all their pages, by entering their domain.

This goal leaves a lot of things unclear. How about things like:

- Do users need to have an account?
- Is the service free to use?
- Do I get the results instantly or do I need to wait?
- Do I get just a score, or information what to fix?

The first two are not all that important. They could change and are not directly related to the problem we're solving, so we don't need to mention this in our goal.

The last two are trickier. **Instant results** sounds directly related, but is it part of the problem we're solving? Maybe not. It could very be the user doesn't mind waiting for the results. Getting **more information** besides the score is actually quite important, otherwise we're just making the problem visible, not solvable, so let's add it to the goal:

> Goal: Give users instructions on how to increase the overall pagespeed of their site by scanning all pages in the domain they enter.

That sounds better! We're stating what we offer, why we do it, and how we do it.

## Define the User Journey

As a user goes through the app there are a few steps he/she will follow to get to the result. This is the _User Journey_ and should be clear from the beginning. If you have too many different ways a user can use the app it will be difficult to build all flows correctly, and what's worse, it will most likely confuse the user.

What would a user journey for Wulfdeck look like.

1.  Enter the domain
2.  See list of pages we find
3.  See instructions on how to increase the pagespeed score for that page

This may sound over-simplified. And it should be. If your user has to go through a lot of steps it's only logical there's more points in the flow the user will stop and not get to the result.

In our case we have actively chosen not to have a user registration system. If we did, however, should it be part of the user flow? It could be, but since the user will probably be logged in in order to use the actual product I personally don't think it should be part of the User Journey. If you think about a flow where the user can use the product, and afterwards can fill out their details to create an account, then you could say it **is** part of the user journey. Still, it sounds more like a feature than a step within our Goal.

**So to summarize**: we define all the steps the user will take to get to the desired 'result' and write them down. This will be your User Journey, and the base for the next step.

## Features per page

If we think of the steps in our User Journey as pages in our webservice, we can then think of features (or pieces of functionality) each page could have. Let's see what we can come up with.

**Enter the domain**

- Should be able to add domain with or without http(s):// and or www
- Form should have validation

**See list of pages**

- Page should show the google pagespeed score for mobile
- Page should show the google pagespeed score for desktop
- Page should show the url and title
- Pages that are 404 should be marked as such
- Pages should be updated in real time as they are crawled
- Scores should be updated in realtime
- Page should show a screenshot
- Should be able to re-check a page for fresh Pagescore

**See instructions on how to increase the pagespeed score per page**

- Should see a list of things that should be fixed
- Should see how many points we gain for fixing an issue
- Should be able to re-check a page for fresh Pagescore
- Should see a screenshot
- Show a visual HAR graph of page loading time
- Offer download of optimized assets

At this point we have a bunch of features, and have to start prioritizing. Basically, for every feature, no matter how cool it sounds, we have to ask ourselves these four questions:

**1: Is this feature directly related to solving the original Goal?**
For the MVP we should really focus on features that solve the original problem. We can always add more features later.

**2: How many users will use this feature**
If a feature is only useful or interestig to a very specific user or usecase its overall usefulness is very low and we probably should not be building it at this stage.

**3: How much work is building this feature**
If a feature is a lot of work you have to consider if it's worth building it straight away. Maybe there's an easier way which isn't ideal, but increases your 'product to market' significantly. You can always add the ideal feature later.

**4: Does it add enough value to the User Experience**
Some features don't really relate to solving a problem but might be worth building after all. For instance, in our case we know the user will have to wait for both the crawling of the site and the pagespeed checks. Implementing 'real time updates' might be a good feature for the MVP in this case. But always consider question 3.

This doesn't mean you should throw all other features out of the window though! You should put them on your **Roadmap** so you can come back to them later. The focus for now is finding those features that are essential to our goal so we can **launch**.

If we look at our list above, the most 'feature fluff' is in the last step. Which makes sense, as that's where we display the end result of our page score results. The list of things we can offer the user there is potentially huge, so we have to make sure for our MVP we focus on what's most important for now.

I think the final MVP list for Wulfdeck features could look like this:

**Enter the domain**

- Form should have validation

**See list of pages**

- Page should show the google pagespeed score for mobile and desktop
- Page should show the url and title
- Scores should be updated in realtime

**See instructions on how to increase the pagespeed score per page**

- Should see a list of things that should be fixed
- Should see how many points we gain for fixing an issue

It definately feels weird to cut out all the extra features, and you might feel the app is not complete without them. However, don't forget we're building a Minimal Viable Product. We're focussing on getting something out there so real world users can play with the core and essentials. The sooner we can learn from our application `out in the wild` the better. Often you will find the features you added to the roadmap are not even the features your users are asking for. Good thing you didn't invest your time in building things people don't want! 😉

## Feature creep

Having defined the MVP the most important next step is; **AVOID FEATURE CREEP**. As you're building your MVP it is not uncommon you think of a **new** exciting features for your application. This is a good thing, but also very dangerous. If you didn't think of it while defining the above list, it's most likely not that important, and can safely be added to the Roadmap.
