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
      series: [{
        name: 'paciente',
        data: data
      }]
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
      series: [{
        name: 'paciente',
        data: data
      }]
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
      series: [{
        name: 'paciente',
        data: data
      }]
    };
  });
});
