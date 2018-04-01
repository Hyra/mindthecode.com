---
title: How to remove a Submodule from your Git repository
subtitle: Submodules are awesome. Adding them is easy enough. But how about getting rid of them again?
description: In this short post I will show you how to get rid of a Git submodule
tags:
  - git
  - submodules
layout: post
header: submodule.gif
date: 2011-05-26
---

In this short post I'll share how to do just that.

We all know having submodules in Git is very handy. You don't have to check all of the code in, just the reference and, when needed, initialize them.

## Traces of submodules

When installing a submodule in Git it does a couple of things. It adds a `record` to your `.gitmodules` file. When this file doesn't exist it will create one. An example of this is:

```javascript
[submodule "some/nice/folder"]
    path = some/nice/folder
    url = git://github.com/your_idol/awesome.git
```

Secondly, it adds the URLs/mappings to your `.git/config` file. This is done when you use `git init submodule`.

Last but not least, it adds references to the submodule in your commits.

## Fine, but how do I get rid of them?

The first two traces are easy enough to remove. Just open up `.gitmodules` and remove the reference to it. Next, open up `.git/config` and remove the mappings there as well. Last, but not least, use the following command from the root directory of your git repository:

```bash
$ git rm --cached path/to/submodule
```

Notice that you have to leave out the trailing slash, else the command will moan about it.

And that's it! Your submodule is gone.

Hope this helps anyone.
