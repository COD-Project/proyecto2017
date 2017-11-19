class Lines {
  constructor(type, options) {
    this.ajax();

    let path = window.location.pathname;

    this.state = {
      data: path.split('/'),
      url_base: window.location.origin,
      `${this.state.url_base}/patients/get/${this.state.data[3]}/healthcontrols/${type}`
    };
  }

  ajax() {
    $.ajax({
      url: this.state.url,
      type: "GET",
      cache: false,
      success: function(response) {
        let data = JSON.parse(response);
        console.log(data);

        new HighchartsLines({
          container: 'lines-chart',
          data: options(data)
        });
      }
    });
  }
}

$('#ccm').click(function() {
      setActive($(this));

      new Lines('weight', function(data) {
        return {
          title: {
            text: 'Gráfico de la evolución del peso mujeres hasta 13 semanas'
          },
          xAxis: {
            title: {
              text: 'Edad (En semanas)'
            },
            min: 0,
            max: 13,
            minorTickInterval: 0.5,
          },
          yAxis: {
            title: {
              text: 'Peso (kg)'
            },
            min: 2,
            max: 8,
            minorTickInterval: 0.1,
          },
          series: data
        };
      });
    }
