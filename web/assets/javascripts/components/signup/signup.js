class Signup {
  constructor() {
    this.data = $('#signup_form').serialize();
    this.ajax();
  }

  ajax() {
    $.ajax({
      url: "http://localhost:3000/signup",
      type: "POST",
      data: this.data,
      cache: false,
      beforeSend: function() {
        $('#signup_response').html(`
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="alert-heading">Procesando petición...</h5>
          </div>
        `);
      },
      success: function(response) {
        let data = JSON.parse(response);
        console.log(data);

        $('#signup_response').html(`
          <div class="alert alert-${data.success ? "success": "danger"} alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="alert-heading">${data.success ? "¡Conexión exitosa!": "Error:"}</h5>
            <p>${data.message}</p>
          </div>
        `);
      },
      error: function() {
        $('#signup_response').html(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h5 class="alert-heading">Error procesando la petición...</h5>
          </div>
        `);
      }
    });
  }
}

$('#signup_form').on('submit', function(e) {
  e.preventDefault();
  $('#signup_form').validate({
    rules: {
      username: "required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        equalTo: '#repeat_password'
      }
    },
    messages: {
      username: "Por favor, especifique su nombre de usuario.",
      email: {
        required: "Necesitamos tu cuenta de email para contactarte.",
        email: "Su dirección de correo electrónico debe tener el formato de name@domain.com"
      },
      password: {
        required: "Por favor, especifique su contraseña.",
        equalTo: "Las contraseñas deben ser iguales"
      }
    },
    errorPlacement: function(error, input) {
      $("#signup_response").html(`
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p>${error.html()}</p>
          </div>
        `);
    },
    submitHandler: function() {
      new Signup;
    }
  });
});
