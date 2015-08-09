---
title: "Format associative JSON to work with Knockout.js"
tags: knockout.js
publishDate: 2012-05-09
template: post.jade
header: associative.gif
---

I recently started creating a RESTful API in CakePHP to work with a Knockout.js frontend.

While Knockout.js is a lot of fun, it does expect your JSON to be in a certain format.

Take the following response from a simple `find` action:

    "Projects": [
        {
            "Project": {
                "id": "151",
                "title": "Een ander project",
                "slug": "een-ander-project",
                "description": "dsfdsfs",
                "tasks_count": "2",
                "tasks_backlog": "2",
                "tasks_open": "0",
                "tasks_closed": "0",
                "duedate": "2012-04-09",
                "created": "2012-04-09 13:52:19",
                "modified": "2012-04-09 13:52:19"
            },
            "Task": [ ]
        },
        {
            "Project": {
                "id": "152",
                "title": "Een ander project",
                "slug": "een-ander-project-1",
                "description": "dsfdsfs",
                "tasks_count": null,
                "tasks_backlog": null,
                "tasks_open": null,
                "tasks_closed": null,
                "duedate": "2012-04-09",
                "created": "2012-04-09 13:55:30",
                "modified": "2012-04-09 13:55:30"
            },
            "Task": [ ]
        },

This is fine to work with in your typical View, but Knockout rather has a nested format, and doesn't like the leading `Project` nodes. You could write custom parsers in Knockout, but would quickly become a hell to maintain.

Instead, I wrote a little function to reformat the response to get the result Knockout likes:

    <?php

    public function formatResponse($data) {
        $ret = array();
        foreach($data as $key) {
            $keys = array_keys($key);
            $t = $key[$keys[0]];
            for($i=1; $i<count($keys); $i++) {
                $t[Inflector::pluralize(strtolower($keys[$i]))] = $key[$keys[$i]];
            }
            $ret[] = $t;
        }

        return $ret;
    }

    $projects = $this->Project->find('all');
    $projects = $this->formatResponse($projects);
    $this->set(compact('projects'));
    $this->set('_serialize', array('projects'));

    ?>

This will reformat the Projects response to:

    "projects": [
        {
            "id": "151",
            "title": "Een ander project",
            "slug": "een-ander-project",
            "description": "dsfdsfs",
            "tasks_count": "2",
            "tasks_backlog": "2",
            "tasks_open": "0",
            "tasks_closed": "0",
            "duedate": "2012-04-09",
            "created": "2012-04-09 13:52:19",
            "modified": "2012-04-09 13:52:19",
            "tasks": [ ]
        },
        {
            "id": "152",
            "title": "Een ander project",
            "slug": "een-ander-project-1",
            "description": "dsfdsfs",
            "tasks_count": null,
            "tasks_backlog": null,
            "tasks_open": null,
            "tasks_closed": null,
            "duedate": "2012-04-09",
            "created": "2012-04-09 13:55:30",
            "modified": "2012-04-09 13:55:30",
            "tasks": [ ]
        },

This way I don't have to worry about modifying the core of how Knockout.js works with JSON, and focus on developing the front-end of my app instead.

It will probably be classier to put the function in something like an `afterFind`, but for now it will do nicely.
