//Scroll to top link
var $toplink = $('.back-to-top');
$toplink.click(function() {
    $('html, body').animate({
        scrollTop: $('body').offset().top
    }, 500);
});



//Fix z-index youtube video embedding
//http://stackoverflow.com/questions/9074365/youtube-video-embedded-via-iframe-ignoring-z-index
$(document).ready(function (){
    $('iframe').each(function(){
        var url = $(this).attr("src");
        $(this).attr("src",url+"?wmode=transparent");
    });
});


//Equal Height flex box fallback
$(document).ready(function() {
  // Get an array of all element heights
  var elementHeights = $('.no-flexbox .flex-item, .no-flexwrap .flex-item').map(function() {
    return $(this).height();
  }).get();

  // Math.max takes a variable number of arguments
  // `apply` is equivalent to passing each height as an argument
  var maxHeight = Math.max.apply(null, elementHeights);

  // Set each height to the max height
  $('.no-flexbox .flex-item, .no-flexwrap .flex-item').height(maxHeight);
});
