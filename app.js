var
	express = require('express'),
	app = express(),
	compass = require('node-compass'),
	Poet = require('poet');

var poet = Poet(app, {
	postsPerPage: 10,
	posts: './_posts',
	metaFormat: 'json',
	routes: {
		'/:post': 'post',
		'/page/:page': 'page',
		'/mytags/:tag': 'tag',
		'/mycategories/:category': 'category',
	}
});

poet.init().then(function () {
	// initialized
});

// TODO: Properly check this
if(!process.env.PORT) {
	app.use(compass());
}

app.set('view engine', 'jade');
app.set('views', __dirname + '/views');
app.use(express.static(__dirname + '/public'));
// app.use(app.routes);

app.get('/about.html', function(req, res, next) {
	res.render('about');
});

app.get('/feed.xml', function(req, res, next) {
	res.redirect(301, 'http://mindthecode.com/rss');
});

app.get('/rss', function(req, res, next) {
  var posts = poet.helpers.getPosts(0, 15);
  res.setHeader('Content-Type', 'application/xml');
  res.render('rss', { posts: posts });
});

app.get('/', function (req, res) { res.render('index');});

var port = process.env.PORT || 3000;
app.listen(port);
