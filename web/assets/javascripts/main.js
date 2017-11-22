new WOW().init();

$('.disabled').click(function(e) {
  e.preventDefault();
});

$('.confirmation').on('click', function() {
  return confirm('¿Estás seguro?');
});
