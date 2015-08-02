var express = require('express');
var compression = require('compression');
var app = express();
var oneDay = 86400000;

app.use(compression());

app.use(express.static(__dirname + '/build/', { maxAge: oneDay }));

if(process.env.NODE_ENV === 'production') {
  app.get('/*', function(req, res, next) {
    if (req.headers.host.match(/^www/) !== null ) {
      res.redirect('http://' + req.headers.host.replace(/^www\./, '') + req.url);
    } else {
      next();     
    }
  });
}

var port = process.env.PORT || 8000;
app.listen(port, function() {
    console.log('listening on', port);
});
