class Lines {
  constructor() {
    this.ajax();
  }

  ajax() {
    $.ajax({
      url: window.location,
      type: "GET",
      cache: false,
      beforeSend: function() {

      },
      success: function(response) {
        let data = JSON.parse(response);
        console.log(data);

      },
      error: function() {

      }
    });
  }
}
