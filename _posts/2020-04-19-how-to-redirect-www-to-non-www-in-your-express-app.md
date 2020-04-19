---
title: How to redirect www traffic to non-www in your Express app
description: >-
  It's good practice to force either www or non-www for your website. But how do you redirect your traffic properly using Express?
tags:
  - javascript
  - express
  - seo
layout: post
header: less-cakephp.gif
date: 2020-04-19
---

{% include carbon.html %}

It's good practice to force either www or non-www for your website. But how do you redirect your traffic properly using Express?

## Middleware

The easiest way to do anything in [Express](https://expressjs.com/) is by using middleware. This way you can process every request and take action if you need to.

```javascript
function redirectWwwTraffic(req, res, next) {
  if (req.headers.host.slice(0, 4) === 'www.') {
      var newHost = req.headers.host.slice(4);
      return res.redirect(301, req.protocol + '://' + newHost + req.originalUrl);
  }
  next();
};

app.set('trust proxy', true);
app.use(redirectWwwTraffic);
```

If you place this before starting your express app it will do the following:

For every request it checks if the host starts with `www`. If it does, it takes the original URL and redirects it to the non-www version with a `301` redirect.

Simple and easy! 👌