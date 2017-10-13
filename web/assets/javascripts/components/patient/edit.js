$('#patient_edit_form').validate({
  rules: {
    firstName: "required",
    lastName: "required",
    address: "required",
    birthday: {
      required: true,
      date: true
    },
    phone: {
      number: true,
      minlength: 7
    },
    documentNumber: {
      required: true,
      number: true,
      minlength: 5,
      maxlength: 9
    }
  },
  messages: {
    firstName: "Por favor, especifique nombre del paciente.",
    lastName: "Por favor, especifique apellido del paciente.",
    address: "Por favor, especifique dirección del paciente.",
    birthday: {
      required: "Por favor, especifique fecha de nacimiento del paciente.",
      date: "Solo se admiten fechas en el campo fecha de nacimiento."
    },
    phone: {
      number: "Solo se admiten números en el campo teléfono.",
      minlength: "Por favor, especifique un número de teléfono válido"
    },
    gender: "Por favor, especifique genero del paciente.",
    documentTypeId: "Por favor, especifique tipo de documento del paciente.",
    documentNumber: {
      required: "Por favor, especifique numero de documento del paciente.",
      number: "Solo se admiten números en el campo número de documento.",
      minlength: "Por favor, especifique un número de documento válido (Mínimo 5 dígitos).",
      maxlength: "Por favor, especifique un número de documento válido (Maximo 9 dígitos)."
    }
  },
  errorPlacement: function(error, input) {
    $("#patient_edit_response").html(`
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
