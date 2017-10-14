$('#settings_edit_form').validate({
  rules: {
    name: "required",
    description: "required",
    amount_per_page: {
      required: true,
      number: true,
      min: 1
    },
    contact: {
      required: true,
      email: true
    }
  },
  messages: {
    name: "Por favor, ingrese el nombre de la aplicación.",
    description: "Por favor, ingrese una descripción.",
    amount_per_page: {
      required: "Por favor, ingrese cantidad de elementos por página.",
      number: "La cantidad de elementos por página debe ser un número.",
      min: "La cantidad mínima de elementos por página es 1."
    },
    contact: {
      required: "Por favor, ingrese un mail de contacto.",
      email: "El formato de mail de contacto es name@domain.com"
    }
  },
  errorPlacement: function(error, input) {
    $("#settings_edit_response").html(`
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <p><small><strong>${error.html()}</strong></small></p>
          </div>
        `);
  },
  submitHandler: function(form) {
    form.submit();
  }
});
