new WOW().init();

$('#login_form').on('submit', function(e) {
  e.preventDefault();
  new Login();
});

$('#signup_form').on('submit', function(e) {
  e.preventDefault();
  new Signup();
});
