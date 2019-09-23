var express = require("express");
var compression = require("compression");
const favicon = require("serve-favicon");
var morgan = require("morgan");

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

// app.use(forceSsl)

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
