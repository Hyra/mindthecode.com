---
title: Setting up Laravel with Docker Compose
subtitle: Streamlined local development
description: >-
  Maintaining a local server for your projects can become cumbersome and can cause conflicts with your co-workers. Streamlining this with Docker makes sure everyone is in on the same page.
tags:
  - docker
  - laravel
layout: post
date: 2016-11-28
---

When you work on multiple projects and run these locally through, for example, Apache this means you have to maintain and tweak your local server environment all the time. Additionally, when you work on that same project with multiple people, chances are your co-workers have a slightly different setup. These slight changes in set-up can be harmless, but more times than not, cause for developer headache or unwanted code-alterations to make it work.

## Enter Docker
Undoubtedly you have heard of [Docker](https://www.docker.com/) and maybe you even played around with it. If you haven't, Docker describes itself as:

> Docker containers wrap up a piece of software in a complete filesystem that contains everything it needs to run: code, runtime, system tools, system libraries – anything you can install on a server. This guarantees that it will always run the same, regardless of the environment it is running in.

Basically, Docker allows you to split up your application in different blocks called `containers` which run the same regardless of where you run them. Every container has a job and does that job by itself. Think NPM for devops.

<!-- Rectangle Ad -->
<!-- <center>
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-0534492338431642"
     data-ad-slot="3199566305"></ins>
</center>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script> -->

This means that every developer can run the project in exactly the same way without having to worry about their local setup and settings. Awesome.

## Add Docker-Compose
Running isolated containers is awesome, but sometimes you need containers to talk to each other. For instance, you have a container for your MySQL database, and one for your PHP application. The latter will want to read and write to the database running in a different container. This is where [Docker Compose](https://docs.docker.com/compose/) comes in:

> Compose is a tool for defining and running multi-container Docker applications

Basically it allows you to orchestrate your containers in a way containers can depend on each other and the ability of them to talk to each other.

## Let's build something
So enough introductionary information, let's put this to practice! As an example we'll get a Laravel application up through Docker-Compose.

What will we be needing to make this work?

* A webserver to serve our application
* PHP >= 5.6.5
* Various PHP modules, such as:
  * OpenSSL PHP Extension
  * PDO PHP Extension
  * Mbstring PHP Extension
  * Tokenizer PHP Extension
  * XML PHP Extension
* A database

Let's start with number one, a basic webserver. In order to create containers through Docker Compose we need to create a new file in our root directory called `docker-compose.yml`.

## Webserver container
Inside this file let's first add the necessary boilerplate:

``` yaml
version: '2'
  # We will use the latest docker-compose variant

services:
  # Here we will define our containers
```

Now we're ready to add our first container. Let's add a container called `webserver` to our services:

``` yaml
version: '2'

services:
  webserver:
    image: 'bitnami/apache:latest'
    ports:
      - '80:80'
```

Now, if you run `docker-compose up` from the command line it will pull in the `bitnami/apache` image and spin up our webserver container. We use `bitnami/apache` as this is a well maintained open source image which gives us sane defaults out of the box. We can also create our own images and use them inside docker-compose but I'll write about that later.

With the container running, you can navigate to `http://localhost` and you should see your typical `It works!` message. Awesome, so we have a webserver running without having to run or configure anything locally besides docker.

## Mapping our filesystem
Next up we should make sure our new webserver knows where to serve our files from. Let's create a directory `htdocs` and add a file `index.php` in there to display the PHP information:

``` php
<?php echo phpinfo(); ?>
```

Now we have to tell our container about our files. Docker Compose has an option `volumes` to map a local folder or file to one in the container. Let's use that to tell our webserver container about the `htdocs` folder.

``` yaml
version: '2'

services:
  webserver:
    image: 'bitnami/apache:latest'
    ports:
      - '80:80'
    volumes:
      - ./htdocs:/app # Map htdocs folder to app
```

In the above statement we've mapped our local `htdocs` folder to the folder `app` in the container. Since we use [Bitnami/Apache](https://github.com/bitnami/bitnami-docker-apache) we know the container uses `/app` as the apache root folder, so by mapping our htdocs to this, our htdocs folder becomes the root.

Stop the docker-compose (`ctrl-c` on mac or unix) process and rerun `docker-compose up`. When everything is up again you can now visit `http://localhost/index.php` and we will see our page!

But wait, it's just showing us the PHP as text without being interpreted.

Time to set up PHP support

## Add PHP to the containers
Now, we have two options here. We can either add an apache configuration file with PHP instructions and add this to our image to override the server settings the same we as we used volumes to map the htdocs folder, or we can say goodbye to our image and create our own Docker image. For the purpose of this walkthrough I think the latter is more beneficial, but just be aware you could do this with the forementioned route as well.

Right, so when we add an `image` inside our `docker-compose.yml` we're refering to pre-fabbed Docker Containers. We can make these ourselves as well, and in essence, that's all an image is, a set of instructions how the container should behave.

Let's create a new file called `Dockerfile` and put it in the root directory alongside `docker-compose.yml'

``` makefile
FROM ubuntu:latest

RUN locale-gen en_US.UTF-8 \
  && export LANG=en_US.UTF-8 \
  && apt-get update \
  && apt-get -y install apache2

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
RUN ln -sf /dev/stdout /var/log/apache2/access.log && \
    ln -sf /dev/stderr /var/log/apache2/error.log
RUN mkdir -p $APACHE_RUN_DIR $APACHE_LOCK_DIR $APACHE_LOG_DIR

VOLUME [ "/var/www/html" ]
WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT [ "/usr/sbin/apache2" ]
CMD ["-D", "FOREGROUND"]

```

In the above we first pull in the latest Ubuntu image. Next, we `RUN` a few commands. First we update the system so it can locate packages, next we install `apache2`. After that we set some Environmental variables for apache. Then we tell the Docker container about the volumes we want to use, expose port 80 and eventually we run apache2 so it can serve files.

Now we need to alter `docker-compose.yml` so it knows to use our own `Dockerfile`:

``` yaml
version: '2'

services:
  webserver:
    build: .
    ports:
      - '80:80'
    volumes:
      - ./htdocs:/var/www/html
```

Notice we changed the volume to map to `/var/www/html` as that's the default location for our container.

Pfew! Let's see where we are at. In the terminal run `docker-compose build` followed by `docker-compose up` to spin things up. We need to run `build` because we're not using an image anymore but our own Dockerfile which needs to be built first. Whenever you make a change it's a good habbit to first run `docker-compose down && docker-compose build` to ensure your changes are propogated.

If all went well we should be able to open the browser at `http://localhost`. But wait, we still don't see PHP being parsed, it's still showing text.

Fear not, with the above rework to use a Dockerfile it's easy to add PHP support by updating the `Dockerfile`

## Add PHP Support through Dockerfile

Open up the `Dockerfile` and add a second `RUN` command to install the other packages we want and enable some modules (yes, the list might be a tad excessive, but hey ..):

``` makefile
RUN apt-get -y install libapache2-mod-php7.0 php7.0 php7.0-cli php-xdebug php7.0-mbstring sqlite3 php7.0-mysql php-imagick php-memcached php-pear curl imagemagick php7.0-dev php7.0-phpdbg php7.0-gd npm nodejs-legacy php7.0-json php7.0-curl php7.0-sqlite3 php7.0-intl apache2 vim git-core wget libsasl2-dev libssl-dev libsslcommon2-dev libcurl4-openssl-dev autoconf g++ make openssl libssl-dev libcurl4-openssl-dev pkg-config libsasl2-dev libpcre3-dev \
  && a2enmod headers \
  && a2enmod rewrite
```

## Rerunning docker-compose
So, let's see what effect this has, run from the command line:

``` bash
$ docker-compose down
$ docker-compose build
$ docker-compose up
```

The build step might take a while, so make sure to get some coffee while that runs, but don't worry, build are incremental and cached, so you won't have to wait for ages every time you want to get your environment up and running.

Once it's all finished, visit `http://localhost`

Huzar! We get the PHP information page.

## Add a database container
We want to run Laravel, which work with a database, so let's get that set up.

Open up `docker-compose.yml` and add another service container:

``` yaml
...
services:
  ...
  db:
    image: mysql:5.7
    volumes:
      - "./.data/db:/var/lib/mysql"
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: laravel_ddb
      MYSQL_USER: laravel
      MYSQL_PASSWORD: laravel
    ports:
      - "3306:3306"
...
```

This container will use another image. This time we won't want to alter the container so the default `mysql:5.7` image will do. One thing to note is I added a `volumes` instruction. This will create a folder `.data` in our project folder which maps to the database container data folder. This makes sure we can persist data, even if we destroy the container and it allows us to commit the database to version control. Now, it's up to you if you want to version control a local db or to .gitignore it, but having persisitent database data is a big win. Of course, you can just safely remove the `volumes` instruction and everything will be fine.

Right, that was easy .. just adding an extra container for extra functionality. And it is.

As part of good practice though, we should add a `depends_on` instruction to the `webserver` container, to make it explicit we want to use the db container,

``` yaml
...
services
  webserver:
    ...
    depends_on:
      - db
...
```

## Installing Laravel
Now let's actually get our application up and running.
I won't go over how to install Laravel, as the nice folks at the [Laravel Documention](https://laravel.com/docs/5.3/installation) do a good job doing that.

Just make sure you end up with the laravel project files and the Docker files in the same directory

Before, we just wanted the `htdocs` to be mapped, but with laravel we want our whole directory to be mapped to the container, so let's change the `volumes` instruction. Additionally, Laravel wants the `public` directory to be the webroot. In order to do that we need to add an apache configuration file to our container.

``` yaml
version: '2'

services:
  webserver:
    build: .
    ports:
      - '80:80'
    volumes:
      - ./:/var/www/html
      - ./apache.conf:/etc/apache2/sites-available/000-default.conf
    depends_on:
      - db

  db:
    image: mysql:5.7
    volumes:
      - "./.data/db:/var/lib/mysql"
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: laravel_ddb
      MYSQL_USER: laravel
      MYSQL_PASSWORD: laravel
    ports:
      - "3306:3306"
```

Notice we can add multiple volumes mappings. The second one maps the apache.conf file we will create in a second to the default website at the container (that way we can just re-use what's already there and don't have to create more server instructions).

The `apache.conf` will look like this:

``` apacheconf
<VirtualHost *:80>
  DocumentRoot /var/www/html/public
  <Directory /var/www/html/public>
    Options Indexes FollowSymLinks MultiViews
    AllowOverride All
    Order allow,deny
    allow from all
  </Directory>
</VirtualHost>
```

And that's it! Now we can run our `docker-compose` commands again:

``` bash
$ docker-compose down
$ docker-compose build
$ docker-compose up
```

And this time when we visit `http://localhost` we should see our fresh Laravel install!

![Huzar](/images/reacts/huzar.gif)

## Caveat

One thing to note is that these containers have their own spaces and thus IP adresses. In order for Laravel to connect to the database container it needs to know where it is. Luckily, we can just use the container name we used in the `docker-compose` file. So instead of connection to `127.0.0.1` we will connect to host `db`. This works, because our mysql container exposes the 3306 port and the webserver container `depends` on the mysql container.

## Summing it up

We now have a `docker-compose` file that instructs Docker to spin up 2 containers, one for our webserver (apache + php) and one for the database. Anyone who pull in the project and runs `docker-compose up` will have the exact same work environment since these files will be under version control.

If in the future a developer decides we need another module, package or server setting, he can just modify the Dockerfile or docker-compose settings, commit it, and it will be propagated to all other developers.

If you have any questions feel free to reach me at [@hyra](http://twitter.com/hyra) or in the comments below.

Happy coding!