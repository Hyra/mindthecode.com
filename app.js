var express = require('express');
var compression = require('compression');
var app = express();
var oneDay = 86400000;

app.use(compression());

app.use(express.static(__dirname + '/build/', { maxAge: oneDay }));

app.all(/.*/, function(req, res, next) {
  var host = req.header("host");
  if (host.match(/^www\..*/i)) {
    next();
  } else {
    res.redirect(301, "http://www." + host);
  }
});

var port = process.env.PORT || 8000;
app.listen(port, function() {
    console.log('listening on', port);
});
