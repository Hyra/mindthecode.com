window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));

$(function() {
	hljs.initHighlightingOnLoad();
	setTimeout(function() {
		$('.badge').addClass('active');
		$('.badge').addClass('floating');
	},666);
	// $('.main').readingTime();
});

window.mobilecheck = function() {
  var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
}

$(document).ready(function(){
  var userAgent = window.navigator.userAgent;
  if(!mobilecheck()) {
    $('article').readingTime();
  }

  $('a').each(function() {
    // if (this.href.match(/kickstarter/)) return;
    if (this.className.match(/social/)) return;
    $(this).css('position', 'relative');
    $(this).mousemove(function(e) {
      if (this.isAlreadyAnimating) return;

      var baseExpX = 4;   // 2 ^ 4 == 16
      var baseExpY = 2;   // 2 ^ 4 == 16

      // element proportions
      var w = this.offsetWidth;
      var h = this.offsetHeight;
      var hw = w/2;
      var hh = h/2;

      var t = $(this);
      var b = t.parent().find('b');
      var both = $.merge(t, b);

      var offsets = t.offset(); // element position relative to page
      var pos = // mouse position relative to element
      {
        x : e.pageX - offsets.left,
        y : e.pageY - offsets.top
      };

      // mouse position offset from center of element
      var cx = pos.x - hw;
      var cy = pos.y - hh;

      // percentage from center to edge
      var px = Math.abs(cx/hw);
      var py = Math.abs(cy/hh);

      // new top/left positions
      var nx = Math.round(Math.pow(2, px * baseExpX)) * (cx < 0 ? -1 : 1);
      var ny = Math.round(Math.pow(2, py * baseExpY)) * (cy < 0 ? -1 : 1);

      both.css(
      {
        zIndex  : 10,
        left  : nx + 'px',
        top   : ny + 'px'
      });
    });

    $(this).mouseout(function(e) { // out
      var t = $(this);
      var b = t.parent().find('b');
      var both = $.merge(t, b);

      var pos = {
        x: parseInt(t.css('left')),
        y: parseInt(t.css('top'))
      };
      t.css('z-index', 1);

      this.isAlreadyAnimating = true;
      both.animate({
        top   : pos.y * -1,
        left  : pos.x * -1
      }, 50, 'swing').animate({
        top   : pos.y * .75,
        left  : pos.x * .75
      }, 75, 'swing').animate({
        top   : pos.y * -.5,
        left  : pos.x * -.5
      }, 50, 'swing').animate({
        top   : pos.y * .25,
        left  : pos.x * .25
      }, 100, 'swing').animate({
        top   : 0,
        left  : 0
      }, 100, 'swing', function() {
        both.css({ zIndex: 0 });
        this.isAlreadyAnimating = false;
      });
    });
  });

});

(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-40203772-4', 'auto');
ga('send', 'pageview');
