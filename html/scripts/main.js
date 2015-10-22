$(document).ready(function() {
  jQuery(window).trigger('resize').trigger('scroll'); /* fixes glitch for now */

  var $container = $('.packery').imagesLoaded( function() {
    $container.packery({
      itemSelector: 'article'
    });
  });

  $('.js-post-modal').on('click', function(e) {
    e.preventDefault();
    $('.post-modal').toggleClass('is-visible');
  });

  $('.cancel').on('click', function(e) {
    e.preventDefault();
    $('.modal').removeClass('is-visible');
  });

  $('.file').on('change', function(e) {
    $('.dropzone').addClass('selected');
  });
});

$(document).keyup(function(e) {
  if (e.keyCode == 27) {
    $('.modal').removeClass('is-visible');
  }
});