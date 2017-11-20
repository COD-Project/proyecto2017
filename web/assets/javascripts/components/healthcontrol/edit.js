$('#healthcontrol_edit_form').validate({
  rules: {
    weight: {
      required: true,
      number: true,
      min: 0,
      minlength: 1,
      maxlength: 9
    },
    height: {
      required: true,
      number: true,
      min: 0,
      minlength: 1,
      maxlength: 9
    },
    pc: {
      required: true,
      number: true,
      min: 0,
      minlength: 1,
      maxlength: 9
    },
    ppc: {
      required: true,
      number: true,
      min: 0,
      minlength: 1,
      maxlength: 9
    },
    physicalExaminationObservations: "required",
    vaccinesObservations: "required",
    maturationObservations: "required"
  },
  messages: {
    weight: {
      required: "Por favor, especifique peso para el paciente.",
      number: "Solo se admiten números en el campo peso.",
      min: "No se admiten pesos negativos",
      minlength: "Por favor, especifique un peso válido (al menos 1 digito).",
      maxlength: "Por favor, especifique un peso válido (Maximo 9 dígitos)."
    },
    height: {
      required: "Por favor, especifique talla para el paciente.",
      number: "Solo se admiten números en el campo talla.",
      min: "No se admiten tallas negativos",
      minlength: "Por favor, especifique una talla válida (al menos 1 digito).",
      maxlength: "Por favor, especifique una talla válida (Maximo 9 dígitos)."
    },
    pc: {
      required: "Por favor, especifique el PC para el paciente.",
      number: "Solo se admiten números en el campo PC.",
      min: "No se admiten PC negativos",
      minlength: "Por favor, especifique un PC válido (al menos 1 digito).",
      maxlength: "Por favor, especifique un PC válido (Maximo 9 dígitos)."
    },
    ppc: {
      required: "Por favor, especifique el PPC para el paciente.",
      number: "Solo se admiten números en el campo PPC.",
      min: "No se admiten PPC negativos",
      minlength: "Por favor, especifique un PPC válido (al menos 1 digito).",
      maxlength: "Por favor, especifique un PPC válido (Maximo 9 dígitos)."
    },
    physicalExaminationObservations: {
        required: "Por favor, especifique una observacion del examen físico del paciente"
    },
    vaccinesObservations:  {
        required: "Por favor, especifique una observacion de las vacunas del paciente"
    },
    maturationObservations:  {
        required: "Por favor, especifique una observacion de la maduración del paciente"
    }
  },
  errorPlacement: function(error, input) {
    $("#healthControl_edit_response").html(`
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
