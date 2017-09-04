(function($) {"use strict";
	var isMobile;
	var stickOnScroll;
	$(document).ready(function() {

		//Header Option
		$('#header').addClass('normal');
		//Choose Here Class Name (normal or fixed or intelligent);

		if ($('.bxslider').length) {
			$('.bxslider').bxSlider({
				minSlides : 2,
				maxSlides : 2,
				slideWidth : 415,
				slideMargin : 10
			});
		}

		$('.tab > div').hide();
		$('.tab > div:first').show();
		$('.bxslider li .features-tab').on('click', function() {
			$('.bxslider li').removeClass('active');
			$(this).parent().addClass('active');
			var blockList = $(this).attr('data-filter');
			//alert(blockList)
			$('.tab > div').hide();
			$('#' + blockList).css({
				'display' : 'block'
			});
		});

		$(".nav-icon").on('click', function() {
			if ($(window).width() < 768) {
				$('.navigation').slideToggle();
			}
		});

		$(".navigation li").on('click', function() {
			if ($(window).width() < 768) {
				$('.sub-menu').slideUp();
				$(this).children('.sub-menu').slideToggle();
			}
		});
		if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
			$('body').addClass('Safari');
		}
		$('.features-text-wrap > div').hide();
		$('.features-text-wrap > div:first').show();
		$('.features-icon li i').on('click', function() {
			$('.features-icon li').removeClass('active')
			$(this).parent().addClass('active');
			var blockList = $(this).attr('data-filter');
			$('.features-text-wrap > div').hide();
			$('#' + blockList).css({
				'display' : 'block'
			});
		});
		//=======================audio player function===================

		if ($('audio').length) {
			$('audio').audioPlayer();
		}

		//===========owl carousel========
		$("#services-slides").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 3,
			itemsDesktop : [1199, 3],
			itemsDesktopSmall : [979, 3],
			itemsMobile : [480, 1]

		});

		$("#about-slides").owlCarousel({
			items : 1,
			itemsDesktop : [1199, 1],
			itemsDesktopSmall : [979, 1],
			itemsTablet : [768, 1],
			navigation : true
		});

		$("#news-slides").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 3,
			itemsDesktop : [1199, 3],
			itemsDesktopSmall : [979, 3],
			itemsMobile : [480, 1]
		});

		$("#testimonial-text").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 2,
			itemsDesktop : [1199, 2],
			itemsDesktopSmall : [979, 2],
			itemsMobile : [480, 1]

		});

		$("#more-slides").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 3,
			itemsDesktop : [1199, 3],
			itemsDesktopSmall : [979, 2],
			itemsMobile : [480, 1]

		});
		$("#testimonial-homepage-8").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 3,
			itemsDesktop : [1199, 3],
			itemsDesktopSmall : [979, 2],
			itemsMobile : [480, 1]

		});

		$("#location-slides").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 3,
			itemsDesktop : [1199, 3],
			itemsDesktopSmall : [979, 2],
			itemsMobile : [480, 1]
		});

		$("#best-seller-items").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds
			navigation : true,
			pagination : false,
			navigationText : ["", ""],

			items : 4,
			itemsDesktop : [1199, 4],
			itemsDesktopSmall : [979, 3],
			itemsMobile : [480, 1]
		});

		$("#countries").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds
			singleItem : true,

			items : 1,

		});

		$("#feedback").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 1,
			itemsDesktop : [1199, 1],
			itemsDesktopSmall : [979, 1],
			itemsTablet : [768, 1],
			itemsMobile : [480, 1]

		});

		$("#feedback-5").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 2,
			itemsDesktop : [1199, 2],
			itemsDesktopSmall : [979, 2],
			itemsTablet : [768, 2],
			itemsMobile : [480, 1]

		});

		$("#services-slides-6").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 2,
			itemsDesktop : [1199, 2],
			itemsDesktopSmall : [979, 2],
			itemsTablet : [768, 2],
			itemsMobile : [480, 1]

		});

		$("#testimonial-tabbing-slides").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 1,
			itemsDesktop : [1199, 1],
			itemsDesktopSmall : [979, 1],
			itemsTablet : [768, 1],
			itemsMobile : [480, 1]

		});

		$("#testimonial-tabbing-slides2").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 1,
			itemsDesktop : [1199, 1],
			itemsDesktopSmall : [979, 1],
			itemsTablet : [768, 1],
			itemsMobile : [480, 1]

		});

		$("#testimonial-tabbing-slides3").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 1,
			itemsDesktop : [1199, 1],
			itemsDesktopSmall : [979, 1],
			itemsTablet : [768, 1],
			itemsMobile : [480, 1]

		});

		$("#testimonial-tabbing-slides4").owlCarousel({
			autoPlay : false, //Set AutoPlay to 3 seconds

			items : 1,
			itemsDesktop : [1199, 1],
			itemsDesktopSmall : [979, 1],
			itemsTablet : [768, 1],
			itemsMobile : [480, 1]

		});

		if ($('.select').length > 0) {
			$(".select").selectbox();
		}

		//==========================	Map function ===============

		if ($('#map-box').length) {
			var map = new GMaps({
				div : '#map-box',
				lat : 33.656651,
				lng : -83.710679,

				disableDefaultUI : true,
				zoom : 10,
				scrollwheel : false
			});
			map.drawOverlay({
				lat : map.getCenter().lat(),
				lng : map.getCenter().lng(),
				content : '<a href="#" class="mapmarker"></a>',
				verticalAlign : 'top',
				horizontalAlign : 'center'
			});

			if ($(window).width() >= 1200) {
				map.setOptions({

					center : new google.maps.LatLng(33.656651, -83.710679),
				});
			} else if ($(window).width() >= 992) {
				map.setOptions({

					center : new google.maps.LatLng(33.656651, -83.710679),
				});
			} else if ($(window).width() >= 768) {
				map.setOptions({

					center : new google.maps.LatLng(33.656651, -83.710679),
				});
			} else {
				map.setOptions({

					center : new google.maps.LatLng(33.656651, -83.710679),
				});
			}
		}

		//this function only for Desktop view
		isMobile = navigator.userAgent.match(/(iPhone|iPod|Android|BlackBerry|iPad|IEMobile|Opera Mini)/);
		if ((!isMobile)) {

			var animSection = function() {
				jQuery('.anim-section').each(function() {
					if (jQuery(window).scrollTop() > (jQuery(this).offset().top - jQuery(window).height() / 1.15)) {
						jQuery(this).addClass('animate');
					}
				});
			};
			if (jQuery('.anim-section').length) {
				animSection();
				jQuery(window).scroll(function() {
					animSection();
				});
			}

			jQuery(window).load(function() {

				if (jQuery('.parallax').length) {
					jQuery('.parallax').each(function() {
						parallax(jQuery(this), 0.1);
					});
				}
			});
			jQuery(window).scroll(function() {
				if (jQuery('.parallax').length) {
					jQuery('.parallax').each(function() {
						parallax(jQuery(this), 0.1);
					});
				}
			});

			jQuery(window).scroll(function() {
				if (jQuery('.help-info.parallax').length) {
					jQuery('.help-info.parallax').each(function() {
						parallax(jQuery(this), 0);
					});
				}
			});
		}
		if ($('#slider-range').length) {
			$("#slider-range").slider({
				range : true,
				min : 0,
				max : 500,
				values : [75, 300],
				slide : function(event, ui) {
					$("#amount").val("$" + ui.values[0]);
					$("#amount1").val("$" + ui.values[1]);
				}
			});

			$("#amount").val("$" + $("#slider-range").slider("values", 0));
			$("#amount1").val("$" + $("#slider-range").slider("values", 1));

			$('#slider-range .ui-slider-handle:first').append(amount);
			$('#slider-range .ui-slider-handle:last').append(amount1);
		}

		// Shop Details
		$(".custom-thumbnail li img").on('click', function() {
			var thumbnail = $(this).attr("src");
			$(".product-1 img").attr("src", thumbnail);
		});

		//=========== Light box function ================
		if ($('.fancybox-media').length) {
			$('.fancybox-media').fancybox({
				openEffect : 'none',
				closeEffect : 'none',
				helpers : {
					media : {}
				}
			});
		}

		//=========== Shopping cart value increase and decrease function ================
		$('.increase').on('click', function() {
			var value = $(this).parents('.quantity-value').find('input').val();
			value++;
			$(this).parents('.quantity-value').find('input').val(value);
		});

		$('.decrease').on('click', function() {
			var value = $(this).parents('.quantity-value').find('input').val();
			if (value > 0) {
				value--;
				$(this).parents('.quantity-value').find('input').val(value);
			}

		});

		//=================Header Style function================
		$(window).load(function() {
			if ($('#header').hasClass('fixed')) {
				$('#header').next().addClass('top-m');
			}
			if ($('#header').hasClass('intelligent')) {
				$('#header').next().addClass('top-m');
			};
		});

		var class_pr = $('body').attr('class');
		var headerHeight = $('#header').outerHeight();
		var st = $(window).scrollTop();
		stickOnScroll = function() {

			if ($('#header').hasClass("intelligent")) {

				$('#header').removeClass('normal');
				$('#header').next().addClass('top-m');
				var pos = $(window).scrollTop();

				if (pos > headerHeight) {
					if (pos > st) {
						$('#header').addClass('simple')
						$('#header.simple').removeClass('down');
						$('#header.simple').addClass('fixed up');

					} else {
						$('#header.simple').removeClass('up');
						$('#header.simple').addClass('fixed down');

					}
					st = pos;

				} else {
					$('#header.simple').removeClass('fixed down up simple');
				}
				if (pos == $(document).height() - $(window).height()) {
					$('#header.simple').removeClass('up');
					$('#header.simple').addClass('fixed down');
				}

			} else if ($('body').hasClass("fix")) {

				$('#header').next().addClass('top-m');
				$('#header').addClass('simple fixed');
				$('#header').removeClass('down up');
				$('#wrapper').css({
					paddingTop : 0
				});
			} else {

				$('#header.simple').removeClass('fixed down up simple');
				$('#header').addClass('normal');
				//$('.spacetop').removeClass('top-m');
				$('#wrapper').css({
					paddingTop : 0
				});
			}
		};
		stickOnScroll();
		$(window).scroll(function() {
			stickOnScroll();
		});

		// end for sticky header

	});
	//===========window scroll function========
	$(window).scroll(function() {
		if (!isMobile) {
			if ($('.parallax').length) {
				$('.parallax').each(function() {
					parallax($(this), 0.1);
				});
			}
		}

		//Header Fix On Scroll
		var posScroll = $(window).scrollTop();
		var primaryH = $('.primary-header').outerHeight();
		if (posScroll > primaryH) {
			$('#header').addClass('fix');
		} else {
			$('#header').removeClass('fix');
		}
	});
	//===========window Load function========
	$(window).load(function() {
		$('.bxslider li').eq(2).addClass('active');

		if ($('.flexslider').length) {
			jQuery('.flexslider').flexslider({
				animation : "slide"
			});
		}
		if ($('.flexslider1').length > 0) {
			$('.flexslider1').flexslider({
				animation : "slide",
				controlNav : false
			});
		}

		$('.loader-block').delay(50).fadeOut();

		if ($('#content-1').length) {
			$("#content-1").mCustomScrollbar({
				theme : "minimal"
			});
		}
		if ($('#content-2').length) {
			$("#content-2").mCustomScrollbar({
				theme : "minimal"
			});
		}
		if (!isMobile) {
			if ($('.parallax').length) {
				$('.parallax').each(function() {
					parallax($(this), 0.1);
				});
			}
		}
		
		//===========masonry section========
	if ($('.masonry-section').length) {
		var container = document.querySelector('.masonry-section');
		var msnry = new Masonry(container, {
			itemSelector : '.blog-items'
		});
	}

	});
	
	var parallax = function(id, val) {
		if ($(window).scrollTop() > id.offset().top - $(window).height() && $(window).scrollTop() < id.offset().top + id.outerHeight()) {
			var px = parseInt($(window).scrollTop() - (id.offset().top - $(window).height()));
			px *= -val;
			id.css({
				'background-position' : 'left ' + px + 'px'
			});
		}
	};

	$('.features-tabing li').on('click', function() {
		$('.features-tabing li').removeClass('active');
		$(this).addClass('active');

		if ($(window).width() < 768) {
			$(this).children('.tab-content').slideToggle();
			$(this).siblings('li').children('.tab-content').slideUp();
		}

	});

	$('.testimonial-tabbing-list li').on('click', function() {
		if ($(window).width() > 767) {
			$('.testimonial-tabbing-list li').removeClass('active-tab');
			$(this).addClass('active-tab');
		}

	});
})(jQuery);
