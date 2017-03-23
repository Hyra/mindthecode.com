var express = require('express')
var compression = require('compression')
const favicon = require('serve-favicon')
var morgan = require('morgan')

var app = express()

function requireHTTPS(req, res, next) {
    if (!req.secure && req.host !== 'localhost') {
        //FYI this should work for local development as well)
        return res.redirect('https://mindthecode.com' + req.url);
    }
    next();
}

// app.use(requireHTTPS);

morgan(function (tokens, req, res) {
  return [
    tokens.method(req, res),
    tokens.url(req, res),
    tokens.status(req, res),
    tokens.res(req, res, 'content-length'), '-',
    tokens['response-time'](req, res), 'ms'
  ].join(' ')
})

app.use(compression())

// app.use(express.static('public'))
const oneDay = 86400000 * 7
app.use(express.static('public', {
  maxage: oneDay
}))

app.use(function(req, res, next){
  res.status(404)
  res.sendfile(__dirname + '/public/404/index.html', { url: req.url })
})

// app.use(compression({ threshold: 0 }))
app.use(favicon(__dirname + '/public/favicon.ico'))

app.listen(process.env.PORT || 3000, function () {
  console.log(`Example app listening on port ${process.env.PORT || 3000}!`)
})

module.exports = app