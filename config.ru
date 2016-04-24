require 'rack/contrib/try_static'

use Rack::Deflater

use Rack::TryStatic,
    :root => "_site",
    :urls => %w[/],
    :try => ['.html', 'index.html', '/index.html'],
    :header_rules => [
      [:all, {'Cache-Control' => 'public, max-age=31536000'}],
      [:fonts, {'Access-Control-Allow-Origin' => '*'}]
    ]

run lambda { |env|
  four_oh_four_page = File.expand_path("../_site/404.html", __FILE__)
  [ 404, { 'Content-Type'  => 'text/html'}, [ File.read(four_oh_four_page) ]]
}
