<!DOCTYPE html>
<html lang="es">
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

    <base href="./../../">

    <title>Hospital Gutiérrez::Olvido Contraseña</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/login.css">
  </head>
  <body>
    <div class="form-container text-center">
      <div class="wrap">
        <div class="brand">
          <img class="brand-img" src="assets/images/logo.png" height="36" alt="Hospital" />
          <h2 class="brand-text font-size-18">Olvido su contraseña</h2>
          <p class="brand-text">Ingrese el mail de su cuenta y se le enviarán instrucciones para recuperar su contraseña</p>
        </div>
        <form action="login" method="post">
          <div class="form-group">
              <div class="input-group">
                  <i class="prefix material-icons">mail</i>
                  <input name="email" id="email" class="full-width" type="email" placeholder="Ingrese su email" value="" title="Ingrese su email" required>
              </div>
          </div>
          <div class="form-group">
              <p>¿No olvidó su contraseña? <a class="text-center" href="login" title="Iniciar Sesión">inicie sesión</a></p>
          </div>
          <button type="submit" class="btn" title="Enviar">Enviar</button>
        </form>
      </div>
    </div>

    <footer class="text-center" style="color: #4285F4; margin-top: 45px;">
      <p>Hospital de Niños Ricardo Gutierrez.</p>
      <p>Proyecto de Software &copy; 2017</p>
    </footer>
  </body>
</html>