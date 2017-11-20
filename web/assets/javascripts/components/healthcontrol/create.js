$('#healthcontrol_create_form').validate({
  rules: {
    weight: {
      required: true,
      number: true
    },
    height: {
      required: true,
      number: true
    },
    vaccinesObservations: {
      required: true
    },
    maturationObservations: {
      required: true
    },
    physicalExaminationObservations: {
      required: true
    }
  },
  messages: {
    weight: {
      required: "Ingrese el peso del paciente",
      number: "El peso debe ser un número"
    },
    height: {
      required: "Ingrese el talle del paciente",
      number: "El talle debe ser un número"
    },
    vaccinesObservations: {
      required: "Ingrese las observaciones sobre las vacunas dadas"
    },
    maturationObservations: {
      required: "Ingrese las observaciones sobre la maduración"
    },
    physicalExaminationObservations: {
      required: "Ingrese las observaciones sobre el examen físico"
    }
  },
  errorPlacement: function(error, input) {
    $("#healthcontrol_create_response").html(`
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
