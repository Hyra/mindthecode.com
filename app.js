var express = require('express');
var compression = require('compression');
var app = express();
var oneDay = 86400000;

app.all('*', function(req, res, next) {
  if (req.headers.host.match(/^www\./) != null) {
    res.redirect("http://" + req.headers.host.slice(4) + req.url, 301);
  } else {
    next();
  }
});

app.use(compression());

app.use(express.static(__dirname + '/build/', { maxAge: oneDay }));

var port = process.env.PORT || 8000;
app.listen(port, function() {
    console.log('listening on', port);
});
