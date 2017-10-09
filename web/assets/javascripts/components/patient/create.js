$('#patient_create_form').validate({
  rules: {
    firstName: "required",
    lastName: "required"
  },
  messages: {
    firstName: "Por favor, especifique nombre del paciente.",
    lastName: "Por favor, especifique apellido del paciente."
  },
  errorPlacement: function(error, input) {
    $("#patient_create_response").html(`
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
