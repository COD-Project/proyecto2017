<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#62a8ea">
    <meta name="keywords"content="Hospital Ricardo Gutiérrez">
    <meta name="description" content="Plataforma web para el Hospital Gutiérrez">
    <meta name="robots" content="index,follow">
    <meta property="og:url" content="https://grupo5.proyecto2017.linti.unlp.edu.ar/" />
    <meta property="og:title" content="Hospital Dr. Ricardo Gutiérrez" />
    <meta property="og:site_name" content="Hospital Gutiérrez" />
    <meta property="og:description" content="Plataforma web para el Hospital Gutiérrez" />
    <meta property="og:image" content="https://grupo5.proyecto2017.linti.unlp.edu.ar/assets/images/icon.png" />

    <title>Hospital Gutiérrez</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
  </head>
  <body>

    <header>
      <nav class="navbar">
          <div class="container">
            <a class="brand" href="#">
              <img class="logo zoomin" src="assets/images/logo-2.png" alt="Logo" title="Logo">
              <p>Hospital Gutiérrez</p>
            </a>
            <div class="separator"></div>
            <div class="nav-group">
              <form class="form-inline" action="#" method="GET">
                <div class="input-group">
                  <i class="suffix material-icons">search</i>
                  <input type="text" name="search" value="" alt="Introduzca su busqueda" title="Introduzca su busqueda" placeholder="Introduzca su busqueda">
                </div>
              </form>
              <ul class="nav-items">
                  <li><a href="./login">Login</a></li>
              </ul>
            </div>
          </div>
      </nav>
    </header>

    <div style="height: 45px; background: transparent;"></div>

    <!-- notification area -->
    <div class="container">
      <hr>
      <div class="row">
        <div class="col-4">
          <div class="card">
            <h4> El Hospital </h4>
            <p> Este centro de salud tiene un programa de residencias de primer nivel en el pais. Se ofrecen oportunidades de práctica intensiva y supervisada en ambitos profesionales y por la misma -por supuesto- se recibe un salario mensual, acorde a lo que la regulación médica profesional lo indica en cada momento. </p>
            <hr>
            <button class="btn" type="submit" alt="Más Información" title="Más Información">Más información</button>
          </div>
        </div>
        <div class="col-4">
          <div class="card">
            <h4> Guardia </h4>
            <p> Hospital Dr. Ricardo Guitierrez de La Plata dispone de un sofisticado servicio de guardias medicas las 24 horas para la atención de distintas urgencias. La administración de la institución hace viable una eficiente superación de los pacientes según el nivel de seriedad y tipo de patología. </p>
            <hr>
            <button class="btn" type="submit" alt="Más Información" title="Más Información">Más información</button>
          </div>
        </div>
        <div class="col-4">
          <div class="card">
            <h4> Especialidades </h4>
            <p> Acorde a una respetable trayectoria en materia de medicina y salud, en Hospital Dr. Ricardo Gutierrez de La Plata podemos encontrar profesionales de salud. Del mismo modo, se brinda atención programada y de urguencias, se realizan estudios médicos y se brinda soporte en muchas de las ramas comunes de la medicina moderna. </p>
            <hr>
            <button class="btn" type="submit" alt="Más Información" title="Más Información">Más información</button>
          </div>
        </div>
      </div>
    </div>

    <!-- footer -->

    <footer class="footer">
      <div class="float-left">
        <p>Hospital de Niños Ricardo Gutierrez.</p>
      </div>
      <div class="float-right">
        <p>Proyecto de Software &copy; 2017</p>
      </div>
    </footer>
  </body>
</html>
