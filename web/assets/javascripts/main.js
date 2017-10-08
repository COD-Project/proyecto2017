new WOW().init();

$('#login_form').on('submit', function(e) {
  e.preventDefault();
  new Login();
});
