require 'rack/contrib/try_static'
require 'rack/rewrite'

use Rack::Deflater

use Rack::Rewrite do
  r301 /.*/,  Proc.new {|path, rack_env| "http://#{rack_env['SERVER_NAME'].gsub(/www\./i, '') }#{path}" },
    :if => Proc.new {|rack_env| rack_env['SERVER_NAME'] =~ /www\./i}

  # Old tag pages
  r301 '/tags/angular.html', '/tags#angular'
  r301 '/tags/php.html', '/tags/#php'
  r301 '/tags/cakephp.html', '/tags/#cakephp'
  r301 '/tags/osx.html', '/tags/#osx'
  r301 '/tags/mamp.html', '/tags/#mamp'
  r301 '/tags/sass.html', '/tags/#sass'
  r301 '/tags/git.html', '/tags/#git'
  r301 '/tags/markdown.html', '/tags/#markdown'
  r301 '/tags/less.html', '/tags/#less'
  r301 '/tags/phpunit.html', '/tags/#phpunit'
  r301 '/tags/spotify.html', '/tags/#spotify'
  r301 '/tags/knockout.js.html', '/tags/#js'
  r301 '/tags/coffeescript.html', '/tags/#coffeescript'
  r301 '/tags/octopress.html', '/tags/#octopress'
  r301 '/tags/vim.html', '/tags/#vim'
  r301 '/tags/terminal.html', '/tags/#terminal'
  r301 '/tags/zsh.html', '/tags/#zsh'
  r301 '/tags/cabinjs.html', '/tags/#cabinjs'
  r301 '/tags/grunt.html', '/tags/#grunt'
  r301 '/tags/http.html', '/tags/#http'
  r301 '/tags/angular.html', '/tags/#angular'
  r301 '/tags/browserify.html', '/tags/#browserify'
  r301 '/tags/gulp.html', '/tags/#gulp'
  r301 '/tags/ffmpeg.html', '/tags/#ffmpeg'
  r301 '/tags/phantomjs.html', '/tags/#phantomjs'
  r301 '/tags/react.html', '/tags/#react'
  r301 '/tags/react-native.html', '/tags/#native'
  r301 '/tags/ios.html', '/tags/#ios'
  r301 '/tags/mobile.html', '/tags/#mobile'
  r301 '/tags/javascript.html', '/tags/#javascript'

  # Posts
  r301 '/getting-your-react-native-app-on-an-ios-device/', '/get-your-react-native-app-running-on-a-device/'
  r301 '/format-associative-json-to-work-with-knockoutjs', '/format-associative-json-to-work-with-knockout-js/'
  r301 '/posts/view/use-gzip-with-php', '/use-gzip-with-php/'
  r301 '/customize-the-terminal-on-osx/', '/customize-the-terminal/'
  r301 '/posts/view/how_to_handle_multiple_domains_with_cakephp', '/how-to-handle-multiple-domains-with-cakephp/'
  r301 '/posts/view/how_to_remove_a_submodule_from_your_git_repository', '/how-to-remove-a-submodule-from-your-git-repository/'
  r301 '/how%20to%20use%20environment%20variables%20in%20your%20angular%20application/', '/how-to-use-environment-variables-in-your-angular-application/'
  r301 '/httpie-a-command-line-http-client/', '/httpie-the-command-line-http-client/'

  r301 '/tag/sass/', '/tags#sass'
  r301 '/tag/markdown/', '/tags/#markdown'
  r301 '/tag/curl/', '/tags/#curl'
  r301 '/cat/coffeescript/', '/tags/#coffeescript'
  r301 '/blog/categories/mamp/', '/tags/#mamp'
  r301 '/blog/categories/git/', '/tags/#git'
  r301 '/blog/categories/command-line/', '/tags'

  r301 '/archives/', '/tags'
  r301 '/archive/', '/tags/'
  r301 '/categories/', '/tags'

  r301 '/archive/3', '/'
  r301 '/posts/index/page:2', '/'
  r301 '/page/10/', '/'
  r301 '/page/6/', '/'
  r301 '/2011/11/', '/'
  r301 '/2011/10/', '/'
  r301 '/author/hyra/page/2/', '/'



end

use Rack::TryStatic,
    :root => "_site",
    :urls => %w[/],
    :try => ['.html', 'index.html', '/index.html'],
    :gzip => true,
    :header_rules => [
      [:all, {'Cache-Control' => 'public, max-age=31536000'}],
      [:fonts, {'Access-Control-Allow-Origin' => '*'}]
    ]

run lambda { |env|
  four_oh_four_page = File.expand_path("../_site/404.html", __FILE__)
  [ 404, { 'Content-Type'  => 'text/html'}, [ File.read(four_oh_four_page) ]]
}
