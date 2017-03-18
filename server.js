var express = require('express')
var compression = require('compression')
const favicon = require('serve-favicon')
var morgan = require('morgan')

var app = express()

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

app.use(express.static('public'))
    
// app.use(compression({ threshold: 0 }))
app.use(favicon('./public/logo.png'))

app.listen(process.env.PORT || 3000, function () {
  console.log(`Example app listening on port ${process.env.PORT || 3000}!`)
})

module.exports = app