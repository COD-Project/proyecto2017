$('#demographic_data_form').validate({
  rules: {
    apartmentTypeId: {
      valueNotEquals : "default"
    },
    socialWorkId: {
      valueNotEquals : "default"
    },
    waterTypeId: {
      valueNotEquals : "default"
    }
  },
  messages: {
    apartmentTypeId: {
      valueNotEquals : "El tipo de vivianda es un campo obligatorio."
    },
    socialWorkId: {
      valueNotEquals : "La obra social es un campo obligatorio."
    },
    waterTypeId: {
      valueNotEquals : "El tipo de agua es un campo obligatorio."
    }
  },
  errorPlacement: function(error, input) {
    $("#demographic_data_response").html(`
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
