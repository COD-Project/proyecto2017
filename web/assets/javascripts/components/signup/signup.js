class Signup {
  constructor() {
    this.data = $('#signup_form').serialize();
    this.ajax();
  }

  ajax() {
    $.ajax({
      url: window.location,
      type: "POST",
      data: this.data,
      cache: false,
      beforeSend: function() {
        $('#signup_response').html(`
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6 class="alert-heading"><strong>Procesando petición...</strong></h6>
          </div>
        `);
      },
      success: function(response) {
        let data = JSON.parse(response);
        console.log(data);

        $('#signup_response').html(`
          <div class="alert alert-${data.success ? "success": "danger"} alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6 class="alert-heading"><strong>${data.success ? "¡Operación exitosa!": "Error:"}</strong></h6>
            <p><strong><small>${data.message}</small></strong></p>
          </div>
        `);

        if (data.success) {
          window.location.reload();
        }
      },
      error: function() {
        $('#signup_response').html(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6 class="alert-heading"><strong>Error procesando la petición...</strong></h6>
          </div>
        `);
      }
    });
  }
}


$('#signup_form').validate({
  rules: {
    firstName: "required",
    lastName: "required",
    username: "required",
    email: {
      required: true,
      email: true
    },
    password: "required",
    repeat_password: {
      required: true,
      equalTo: '#password'
    }
  },
  messages: {
    firstName: "Por favor, especifique su nombre.",
    lastName: "Por favor, especifique su apellido.",
    username: "Por favor, especifique su nombre de usuario.",
    email: {
      required: "Necesitamos tu cuenta de email para contactarte.",
      email: "Su dirección de correo electrónico debe tener el formato de name@domain.com"
    },
    password: "Por favor, especifique su contraseña.",
    repeat_password: {
      required: "Por favor, especifique nuevamente su contraseña.",
      equalTo: "Las contraseñas deben ser iguales."
    }
  },
  errorPlacement: function(error, input) {
    $("#signup_response").html(`
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><small><strong>${error.html()}</strong></small></p>
          </div>
        `);
  },
  submitHandler: function(form) {
    new Signup;
  }
});
