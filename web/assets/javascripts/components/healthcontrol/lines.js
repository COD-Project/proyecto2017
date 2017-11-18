class Lines {
  constructor() {
    this.ajax();

    let path = window.location.pathname;

    this.state = {
        data: path.split('/')
    };
  }

  ajax() {
    $.ajax({
      url: window.location.origin + `/patients/get/${this.state.data[3]}/healthcontrols`,
      type: "GET",
      cache: false,
      success: function(response) {
        let data = JSON.parse(response);
        console.log(data);

        new HighchartsLines({
          container: '#lines',
          data: data
        });
      }
    });
  }
}
