var express = require("express");
var compression = require("compression");
const favicon = require("serve-favicon");
var morgan = require("morgan");
var redirects = require("./url_list.json");

var app = express();

function forceSsl(req, res, next) {
  if (
    req.header("x-forwarded-proto") !== "https" &&
    req.header("host") !== "localhost"
  ) {
    return res.redirect("https://" + req.header("host") + req.url);
  } else {
    return next();
  }
}
if (process.env.NODE_ENV === "production") {
  app.use(forceSsl);
}

// Redirects
app.use(function(req, res, next) {
  const match = redirects.filter(i => {
    return i.old === req.url;
  });
  if (match.length) {
    return res.redirect(match[0].code, match[0].new);
  }
  next();
});

function wwwRedirect(req, res, next) {
  if (req.headers.host.slice(0, 4) === 'www.') {
      var newHost = req.headers.host.slice(4);
      return res.redirect(301, req.protocol + '://' + newHost + req.originalUrl);
  }
  next();
};
app.set('trust proxy', true);
app.use(wwwRedirect);

morgan(function(tokens, req, res) {
  return [
    tokens.method(req, res),
    tokens.url(req, res),
    tokens.status(req, res),
    tokens.res(req, res, "content-length"),
    "-",
    tokens["response-time"](req, res),
    "ms"
  ].join(" ");
});

app.use(compression());

app.use(express.static("public"));
const oneDay = 86400000 * 7;
app.use(
  express.static(__dirname + "/_site", {
    maxage: oneDay,
    extensions: "html"
  })
);

app.use(function(req, res, next) {
  res.status(404);
  res.sendFile(__dirname + "/_site/404.html", { url: req.url });
});

// app.use(compression({ threshold: 0 }))
app.use(favicon(__dirname + "/_site/favicon.png"));

app.listen(process.env.PORT || 3000, function() {
  console.log(`Example app listening on port ${process.env.PORT || 3000}!`);
});

module.exports = app;
