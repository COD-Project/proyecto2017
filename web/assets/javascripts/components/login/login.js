class Login {
  constructor() {
    this.ajax();
  }

  ajax() {
    $.ajax({
      url: "http://localhost:3000/login",
      type: "POST",
      data: $('#login_form').serialize(),
      cache: false,
      beforeSend: function() {
        $('#login_response').html(`
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6 class="alert-heading"><strong>Procesando petición...</strong></h6>
          </div>
        `);
      },
      success: function(response) {
        let data = JSON.parse(response);
        console.log(data);

        $('#login_response').html(`
          <div class="alert alert-${data.success ? "success": "danger"} alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6 class="alert-heading"><strong>${data.success ? "¡Conexión exitosa!": "Error:"}</strong></h6>
            <p><strong><small>${data.message}</small></strong></p>
          </div>
        `);
      },
      error: function() {
        $('#login_response').html(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6 class="alert-heading"><strong>Error procesando la petición...</strong></h6>
          </div>
        `);
      }
    });
  }
}

$('#login_form').validate({
  rules: {
    username: "required",
    password: "required"
  },
  messages: {
    username: "Por favor, especifique su nombre de usuario.",
    password: "Por favor, especifique contraseña."
  },
  errorPlacement: function(error, input) {
    $("#login_response").html(`
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><small><strong>${error.html()}</strong></small></p>
          </div>
        `);
  },
  submitHandler: function(form) {
    new Login;
  }
});
