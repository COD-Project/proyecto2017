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
            <h5 class="alert-heading">Procesando petición...</h5>
          </div>
        `);
      },
      success: function(response) {
        let data = JSON.parse(response);
        console.log(data);

        $('#login_response').html(`
          <div class="alert alert-${data.success ? "success": "danger"} alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="alert-heading">${data.success ? "¡Conexión exitosa!": "Error:"}</h5>
            <p>${data.message}</p>
          </div>
        `);
      },
      error: function() {
        $('#login_response').html(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="alert-heading">Error procesando la petición...</h5>
          </div>
        `);
      }
    });
  }
}

$('#login_form').on('submit', function(e) {
  e.preventDefault();
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
            <p>${error.html()}</p>
          </div>
        `);
    },
    submitHandler: function() {
      new Login;
    }
  });
});
