<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#62a8ea">
    <meta name="keywords" content="Hospital Ricardo Gutiérrez">
    <meta name="description" content="Plataforma web para el Hospital Gutiérrez">
    <meta name="robots" content="index,follow">
    <meta property="og:url" content="https://grupo5.proyecto2017.linti.unlp.edu.ar/" />
    <meta property="og:title" content="Hospital Dr. Ricardo Gutiérrez" />
    <meta property="og:site_name" content="Hospital Gutiérrez" />
    <meta property="og:description" content="Plataforma web para el Hospital Gutiérrez" />
    <meta property="og:image" content="https://grupo5.proyecto2017.linti.unlp.edu.ar/assets/images/icon.png" />

    <base href="./../">

    <title>Hospital Gutiérrez</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/select.css">
  </head>
  <body>
    <header>
      <nav class="navbar">
          <div class="container">
            <a class="brand" href="#" title="Inicio">
              <img class="logo zoomin" src="assets/images/logo-2.png" alt="Logo" title="Logo">
              <p>Hospital Gutiérrez</p>
            </a>
            <div class="separator"></div>
            <div>
              <select class="styled-select blue semi-square" title="Menu de Administración">
                <option selected disabled>Menu</option>
                <option value="" title="Menu de Usuarios">Usuarios</option>
                <option value="" title="Menu de Roles">Roles</option>
                <option value="" title="Menu de Permisos">Permisos</option>
              </select>
            </div>
            <div class="nav-group">
              <form class="form-inline" action="#" method="GET">
                <div class="input-group">
                  <i class="suffix material-icons">search</i>
                  <input type="text" name="search" value="" title="Introduzca su busqueda" placeholder="Introduzca su busqueda">
                </div>
              </form>
              <ul class="nav-items">
                  <li><a href="./" title="Cerrar Sesión">Logout</a></li>
              </ul>
            </div>
          </div>
      </nav>
    </header>

    <!--  -->

    <footer class="footer">
      <p>Hospital de Niños Ricardo Gutierrez.</p>
      <p>Proyecto de Software &copy; 2017</p>
    </footer>
  </body>
</html>
