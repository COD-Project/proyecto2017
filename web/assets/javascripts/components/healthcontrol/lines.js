class Lines {
  constructor(sex, type, options) {
    let path = window.location.pathname;

    this.state = {
      data: path.split('/'),
      url_base: window.location.origin,
      sex: sex,
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
      url: `${this.state.url_base}/healthcontrols/analytics/${this.state.sex}/${this.state.type}`,
      type: "GET",
      cache: false,
      success: this.success.bind(this)
    });
  }
}


$('#men-weight-chard').click(function() {
  new Lines('masculino', 'weight', function(data) {
    return {
      title: {
        text: 'Gráfico de la evolución del peso en hombres hasta 13 semanas'
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

$('#women-weight-chard').click(function() {
  new Lines('femenino', 'weight', function(data) {
    return {
      title: {
        text: 'Gráfico de la evolución del peso en Mujeres hasta 13 semanas'
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

$('#men-height-chard').click(function() {
  new Lines('masculino', 'height', function(data) {
    return {
      title: {
        text: 'Gráfico de la evolución de la talla en hombres hasta 2 años'
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

$('#women-height-chard').click(function() {
  new Lines('femenino', 'height', function(data) {
    return {
      title: {
        text: 'Gráfico de la evolución de la talla en mujeres hasta 2 años'
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

$('#men-ppc-chard').click(function() {
  new Lines('masculino', 'ppc', function(data) {
    return {
      title: {
        text: 'Gráfico de la evolución del PPC en hombres hasta 13 semanas'
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

$('#women-ppc-chard').click(function() {
  new Lines('femenino', 'ppc', function(data) {
    return {
      title: {
        text: 'Gráfico de la evolución del PPC en mujeres hasta 13 semanas'
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
