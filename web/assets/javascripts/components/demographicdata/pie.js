class Pie {
  constructor(type, title) {
    let path = window.location.pathname;

    this.state = {
      data: path.split('/'),
      url_base: window.location.origin,
      type: type,
      title: title
    };

    this.ajax();
  }

  success(response) {
    let data = JSON.parse(response);

    if (data.success) {
      new HighchartsPie({
        container: this.state.type,
        data: data.data,
        title: this.state.title
      });
    } else {
      console.log(this.state.type);
      $("#" + this.state.type).html('<h3 class="text-center">Parece que no hay grafico para mostrar. Cargue datos y vuelva a intentarlo</h3>');
    }
  }

  ajax() {
    $.ajax({
      url: `${this.state.url_base}/demographicdata/get/${this.state.type}`,
      type: "GET",
      cache: false,
      success: this.success.bind(this)
    });
  }
}

$("#demographicDataData", function() {
  new Pie('demographicDataData', 'Procentaje de pacientes con datos demográficos');
});

$("#waterTypeData", function() {
  new Pie('waterTypeData', 'Tipos de agua');
});


$("#heatingTypeData", function() {
  new Pie('heatingTypeData', 'Tipos de calefacción');
});


$("#apartamentTypeData", function() {
  new Pie('apartamentTypeData', 'Tipos de vivienda');
});

$("#refrigeratorData", function() {
  new Pie('refrigeratorData', 'Tiene heladera');
});

$("#electricityData", function() {
  new Pie('electricityData', 'Tiene electricidad');
});

$("#petData", function() {
  new Pie('petData', 'Tiene mascota');
});
