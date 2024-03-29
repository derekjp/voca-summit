/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *	// update the viewport, in case the window size has changed
 *	viewport = updateViewportDimensions();
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
*/

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
  */
  loadGravatars();


/* Custom JS */

//First things first, make Wordpress images responsive.
//Kinda silly that we still need this right?
jQuery(document).ready(function($) {

        // Remove width & height attributes from images (added by default in WordPress)
  $('img').removeAttr('width').removeAttr('height');

        // Remove style attribute on image captions, which sets a fixed width by default
    $('.wp-caption').removeAttr('style');

});


//Mobile Nav Triggers
// $(document).ready(function() {
//   var menu = $(".nav-mobile-trigger");
//
//   menu.on("click", function(e){
//     e.preventDefault();
//     $('body').toggleClass('activated');
//   });
// });

$('.top-link').click(function() {
    $('html, body').animate({
        scrollTop: $('body').offset().top
    }, 500);
});


//Reusable Open/Close function
$('.trigger').click(function() {
  var $this = $(this),
  notThis = $this.hasClass('open'),
  thisNav = $this.attr("rel");
  //close if you click another menu trigger
  if (!notThis) {
    $('.triggered-area, .trigger').removeClass('open');
    if ( $( '.trigger' ).hasClass( "block-scroll" ) ){
      $('html').removeClass('disable-scroll');
      $('#overlay-mobile').removeClass('visible');
    }
  }
  //open the nav
  $this.toggleClass('open');
  $("#"+thisNav).toggleClass('open');
  if ( $( this ).hasClass( "block-scroll" ) ){
    $('html').toggleClass('disable-scroll');
    $('#overlay-mobile').toggleClass('visible');
  }
});
//close if you click on anything but this nav item or a trigger
$(document).on('click', function(event) {
  if (!$(event.target).closest('.triggered-area, .trigger').length) {
    $('.triggered-area, .trigger').removeClass('open');
    if ( $( '.trigger' ).hasClass( "block-scroll" ) ){
      $('html').removeClass('disable-scroll');
      $('#overlay-mobile').removeClass('visible');
    }
  }
});

//Close button
$('.close-button').click(function() {
  $('.triggered-area, .trigger').removeClass('open');
  $('html').removeClass('disable-scroll');
  $('#overlay-mobile').removeClass('visible');
});


$(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash;
	    var $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
});

}); /* end of as page load scripts */
