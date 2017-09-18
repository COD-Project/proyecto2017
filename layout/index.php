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
            <div class="nav-group">
              <form class="form-inline" action="#" method="GET">
                <div class="input-group">
                  <i class="suffix material-icons">search</i>
                  <input type="text" name="search" value="" title="Introduzca su busqueda" placeholder="Introduzca su busqueda">
                </div>
              </form>
              <ul class="nav-items">
                  <li>
                    <div class="dropdown">
                      <a class="dropbtn" title="Menu">Menu</a>
                      <div class="dropdown-content">
                        <a href="layout" title="Usuarios"><i class="material-icons">perm_identity</i> Usuarios</a>
                        <a href="layout" title="Roles"><i class="material-icons">security</i> Roles</a>
                        <a href="layotu" title="Permisos"><i class="material-icons">security</i> Permisos</a>
                        <a href="./login" title="Iniciar Sesión"><i class="material-icons">security</i> Login</a>
                        <a href="." title="Cerrar Sesión"><i class="material-icons">security</i> Logout</a>
                      </div>
                    </div>
                  </li>
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
