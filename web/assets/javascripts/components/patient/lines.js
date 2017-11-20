class Lines {
  constructor(type, options) {
    let path = window.location.pathname;

    this.state = {
      data: path.split('/'),
      url_base: window.location.origin,
      type: type,
      options: options
    };

    this.ajax();
  }

  success(response) {
    let data = JSON.parse(response);

    if (data.success) {
      new HighchartsLines('lines-chart', this.state.options(data.data));
    }
  }

  ajax() {
    $.ajax({
      url: `${this.state.url_base}/patients/get/${this.state.data[3]}/healthcontrols/${this.state.type}`,
      type: "GET",
      cache: false,
      success: this.success.bind(this)
    });
  }
}


$('#weight-chard').click(function() {
  new Lines('weight', function(data) {
    return {
      title: {
        text: 'Gráfico de la evolución del peso'
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
});

$('#height-chard').click(function() {
  new Lines('height', function(data) {
    return {
      title: {
        text: 'Gráfico de la evolución de la talla'
      },
      xAxis: {
        title: {
          text: 'Longitud (En cm.)'
        },
        minorTickInterval: 0.5,
      },
      yAxis: {
        title: {
          text: 'Peso (kg)'
        },
        minorTickInterval: 0.5,
      },
      series: data
    };
  });
});

$('#ppc-chard').click(function() {
  new Lines('ppc', function(data) {
    return {
      title: {
        text: 'Gráfico de la evolución del PPC'
      },
      xAxis: {
        title: {
          text: 'Edad (En semanas)'
        },
        minorTickInterval: 0.5,
      },
      yAxis: {
        title: {
          text: 'Circunferencia cefálica (En cm.)'
        },
        minorTickInterval: 0.1,
      },
      series: data
    };
  });
});
