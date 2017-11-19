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
          marker: {
            enabled: false,
          },
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

    if (data.success && data.data.length > 0) {
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
