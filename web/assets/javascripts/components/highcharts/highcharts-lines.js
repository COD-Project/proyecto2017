class HighchartsLines {
  constructor(container, options) {
    console.log(options);
    Highcharts.setOptions({
      chart: {
        renderTo: container,
        height: 600,
        borderWidth: 1,
        borderColor: 'rgba(179, 224, 232, .9)',
        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
        plotBorderWidth: 0.3,
        type: 'spline',
      },
      plotOptions: {
        series: {
          lineWidth: 1,
        },
        xAxis: {
          tickInterval: 0.1,
        },
        yAxis: {
          tickInterval: 0.1,
        },
      },
    });

    Highcharts.chart(options);
  }
}
