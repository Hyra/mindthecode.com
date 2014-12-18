'use strict';

$(function() {
	var $navBar = $('nav');

	// If touchscreen listen for touch, if not listen for click
	var hitEvent = 'ontouchstart' in document.documentElement ? 'touchstart' : 'click';

	// Toggle the nav menu list when the user clicks the nav menu button
	$('.menu').on(hitEvent, function () {
		$navBar.toggleClass('nav-show');
	});

	$('.content').on(hitEvent, function(event) {
		if ($navBar.hasClass('nav-show')) {
			$navBar.removeClass('nav-show');
		}
	});

	window.onscroll = function(e) {
		if(window.pageYOffset < 270) {
			// $('.header').removeClass('fixed');
			// $('.content').removeClass('topped');
		}
		if(window.pageYOffset >= 270) {
			// $('.header').addClass('fixed');
			// $('.content').addClass('topped');
		}
		if(window.pageYOffset >= 30) {
			$('.top').addClass('active');
		}
		if(window.pageYOffset < 30) {
			$('.top').removeClass('active');
		}

		var $bgobj = $('.bg');
		var yPos = -($(window).scrollTop() / 5); 
		var coords = '50% '+ yPos + 'px';
		// $bgobj.css({ backgroundPosition: coords });
	};

	hljs.initHighlightingOnLoad();

});
