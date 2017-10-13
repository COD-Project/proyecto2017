$('#role_create_form').validate({
  rules: {
    name: "required",
    permissionsId: "required"
  },
  ignore: ':disabled:not("#permissionsId")',
  messages: {
    name: "Por favor, especifique nombre del rol.",
    permissionsId: "Por favor, especifique al menos un permiso."
  },
  errorPlacement: function(error, input) {
    $("#role_create_response").html(`
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
