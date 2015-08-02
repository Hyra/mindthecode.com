var metalsmith = require('metalsmith'),
    markdown = require('metalsmith-markdown'),
    templates = require('metalsmith-templates'),
    serve = require('metalsmith-serve'),
    watch = require('metalsmith-watch'),
    excerpts = require('metalsmith-excerpts'),
    collections = require('metalsmith-collections'),
    branch = require('metalsmith-branch'),
    permalinks = require('metalsmith-permalinks'),
    feed = require('metalsmith-feed'),
    wordcount = require('metalsmith-word-count'),
    sitemap = require('metalsmith-sitemap'),
    metallic = require('metalsmith-metallic'),
    tags = require('metalsmith-tags'),
    moment = require('moment'),
    sass = require('metalsmith-sass'),
    path = require('metalsmith-path'),
    redirect = require('metalsmith-redirect');

var siteBuild = metalsmith(__dirname)
    .metadata({
      site: {
        title: 'Mindthecode',
        url: 'http://mindthecode.com'
      }
    })
    .source('./src')
    .destination('./build')
    .use(markdown())
    .use(metallic())
    .use(excerpts())
    .use(collections({
      posts: {
        pattern: 'posts/**.html',
        sortBy: 'publishDate',
        reverse: true
      },
      content: {
        pattern: 'content/**.md'
      }
    }))
    .use(branch('posts/**.html')
        .use(permalinks({
          pattern: ':title/',
          relative: true
        }))
    )
    .use(branch('content/**.html')
        .use(permalinks({
          pattern: ':title',
          relative: true
        }))
    )
    .use(branch('!posts/**.html')
        .use(branch('!index.md').use(permalinks({
          relative: false
        })))
    )
    .use(wordcount({
      metaKeyCount: "wordCount",
      metaKeyReadingTime: "readingTime",
      speed: 300,
      seconds: false,
      raw: false
    }))
    .use(tags({
        handle: 'tags',                  // yaml key for tag list in you pages
        path:'tags/:tag.html',                   // path for result pages
        template:'tagged.jade',    // template to use for tag listing
        sortBy: 'publishDate',                  // provide posts sorted by 'date' (optional)
        reverse: true                    // sort direction (optional)
    }))
    .use(templates({
      engine: 'jade',
      moment: moment
    }))
    .use(feed({
      collection: 'posts',
      limit: false
    }))
    .use(path())
    .use(sitemap({
       output: 'sitemap.xml',
       urlProperty: 'path',
       hostname: 'http://mindthecode.com',
       defaults: {
         priority: 0.5,
         changefreq: 'daily'
       }
    }))
    .use(sass({
      outputStyle: "expanded",
      outputDir: 'css/'
    }))
    .use(redirect({
      // '/lets-build-an-angularjs-app-with-browserify-and-gulp/': '/let-s-build-an-angularjs-app-with-browserify-and-gulp/'
    }));

if (process.env.NODE_ENV !== 'production') {
  siteBuild = siteBuild
      .use(serve({
        port: 8082,
        verbose: true
      }))
      .use(watch({
        pattern: '**/*',
        livereload: true
      }))
}
siteBuild.build(function (err) {
      if (err) {
        console.log(err);
      }
      else {
        console.log('Site build complete!');
      }
    });
