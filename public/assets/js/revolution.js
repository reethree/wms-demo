//===========revolution slider plugin========
	(function($) {
	"use strict";
	$('.banner').revolution({
         delay:3000,
         startwidth:960,
         startheight:500,
         startWithSlide:0,
 
         fullScreenAlignForce:"on",
         autoHeight:"on",
         minHeight:"off",
 
         shuffle:"on",
 
         onHoverStop:"on",
 
         thumbWidth:100,
         thumbHeight:50,
         thumbAmount:3,
 
         hideThumbsOnMobile:"off",
         hideNavDelayOnMobile:1500,
         hideBulletsOnMobile:"off",
         hideArrowsOnMobile:"off",
         hideThumbsUnderResoluition:0,
 
         hideThumbs:0,
         hideTimerBar:"on",
 
         keyboardNavigation:"on",
 
         navigationType:"none",
         navigationArrows:"nexttobullets",
         navigationStyle:"off", 
 
         navigationHAlign:"left",
         navigationVAlign:"center",
         navigationHOffset:30,
         navigationVOffset:30,
 
         soloArrowLeftHalign:"left",
         soloArrowLeftValign:"center",
         soloArrowLeftHOffset:20,
         soloArrowLeftVOffset:0,
 
         soloArrowRightHalign:"right",
         soloArrowRightValign:"center",
         soloArrowRightHOffset:20,
         soloArrowRightVOffset:0,
 
 
         touchenabled:"off",
         swipe_velocity:"0.7",
         swipe_max_touches:"1",
         swipe_min_touches:"1",
         drag_block_vertical:"true",
 
         parallax:"mouse",
         parallaxBgFreeze:"off",
         parallaxLevels:[10,7,4,3,2,5,4,3,2,1],
         parallaxDisableOnMobile:"off",
 
         stopAtSlide:-1,
         stopAfterLoops:-1,
         hideCaptionAtLimit:0,
         hideAllCaptionAtLilmit:0,
         hideSliderAtLimit:0,
 
         dottedOverlay:"none",
 
         spinned:"spinner4",
 
         fullWidth:"on",
         forceFullWidth:"on",
         fullScreen:"on",
         fullScreenOffsetContainer:"#topheader-to-offset",
         fullScreenOffset:"0px",
 
         panZoomDisableOnMobile:"off",
 
         simplifyAll:"off",
 
         shadow:0
 
      });
	})(jQuery);
	