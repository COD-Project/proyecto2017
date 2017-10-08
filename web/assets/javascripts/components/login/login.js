class Login {
  constructor() {
    let form = document.getElementById('login_form');

    this.state = {
      username: form.username.value,
      password: form.password.value
    }

    this.ajax();
  }

  ajax() {
    $.ajax({
      url: "http://localhost:3000/login",
      type: "POST",
      data: this.data,
      cache: false,
      contentType: "application/json"
    }).done(function(response) {
      let data = JSON.parse(response);

      $('#login_response').html(`
        <div class="alert alert-${data.success ? "success": "danger"} alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong></strong> ${data.message} </a>
        </div>
      `);
    });
  }
}
