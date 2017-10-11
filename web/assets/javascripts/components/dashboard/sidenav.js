$(document).ready(function() {
  var trigger = $('.hamburger'),
    is_open = $('.hamburger').hasClass('is-open');

  trigger.click(function() {
    if (is_open == true) {
      trigger.removeClass('is-open');
      trigger.addClass('is-closed');
      is_open = false;
    } else {
      trigger.removeClass('is-closed');
      trigger.addClass('is-open');
      is_open = true;
    }
  });

  $('[data-toggle="offcanvas"]').click(function() {
    $('#wrapper').toggleClass('toggled');
  });


  if ($(window).width() <= 768) {
    is_open = false;
    $('#wrapper').removeClass('toggled');
    trigger.removeClass('is-open');
    trigger.addClass('is-closed');
  }
});
