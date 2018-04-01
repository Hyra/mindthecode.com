---
title: How to handle multiple domains with CakePHP
description: >-
  The following setup can work nicely when you develop your sites locally and
  don't want to change the configuration every time you upload it.
tags:
  - cakephp
  - php
  - domains
  - osx
layout: post
header: multiple-domains.gif
date: 2011-05-22
---

Lately, we've been working with multiple environments/servers for our websites to be able to have them approved by clients before going live. However, following set up can also work nicely when you develop your sites locally and don't want to keep changing the configuration every time you upload it.

## Setting up the database config file

So, what changes in your config? Not all that much. Let's have a look at the default database.php config file

```javascript
class DATABASE_CONFIG {

    var $default = array(
    'driver' => 'mysql',
    'persistent' => false,
    'host' => 'localhost',
    'login' => 'user',
    'password' => 'password',
    'database' => 'database_name',
    'prefix' => '',
    );

    var $test = array(
    'driver' => 'mysql',
    'persistent' => false,
    'host' => 'localhost',
    'login' => 'user',
    'password' => 'password',
    'database' => 'test_database_name',
    'prefix' => '',
    );
}
```

The `$default` database config is used when you don't specify anything. The `$test` database is used by SimpleTest. Let's say you want to have a `local` environment and one for when you're on your live/production server. Below is the database config I use

```javascript
class DATABASE_CONFIG {

    var $local = array(
        'driver' => 'mysql',
        'persistent' => false,
        'encoding' => 'utf8',
        'host' => 'localhost',
        'login' => 'root',
        'password' => 'root',
        'database' => '',
        'prefix' => '',
        'port' => '/Applications/MAMP/tmp/mysql/mysql.sock',
    );

    var $production = array(
        'driver' => 'mysql',
        'persistent' => false,
        'encoding' => 'utf8',
        'host' => 'localhost',
        'login' => '',
        'password' => '',
        'database' => '',
        'prefix' => '',
        'port' => '',
    );

    public function __construct() {
      if(isset($_SERVER['SERVER_NAME'])) {
        switch($_SERVER['SERVER_NAME']) {
          // Are we working locally?
          case 'www.YOURLOCALURL.com':
            $this->default = $this->local;
            Configure::write('debug', 2);
            break;
          case 'www.YOURLIVEURL.com':
            $this->default = $this->production;
            Configure::write('debug', 0);
            break;
          default:
            $this->default = $this->production;
            Configure::write('debug', 0);
            break;
        }
      } else {
        // If there's no SERVER_NAME we're probably using bake from the command line, so use local
        $this->default = $this->local;
      }
  }

}
```

As you can see we check the `$_SERVER['SERVER_NAME']` . Locally I like to work with `dev.domain.com` domains, but if you're using some sort of `localhost` structure this will work fine as well. So, depending on the server(name) you're on the correct database credentials are put into the `$default` config. Obviously, you can extend the database configs as much as you want. We usually work with 4 arrays: local, development, staging and production. As a bonus, we can set the `debug value` for these environments accordingly as well.

## Thoughts?

I have been considering putting this logic in the `bootstrap.php`, but not sure if this is where one would want this logic. Do you guys use a similar setup, or know ways to improve or extend this? Let me know in the comments!
