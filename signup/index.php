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

    <base href="./../">

    <title>Hospital Gutiérrez::Registrar Usuario</title>

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
          <h2 class="brand-text font-size-18">Registrar Usuario</h2>
        </div>
        <form action="." method="post">
          <div class="form-group">
              <div class="input-group">
                  <i class="prefix material-icons">perm_identity</i>
                  <input name="nombre" id="nombre" class="full-width" type="text" placeholder="Ingrese Nombre" value="" title="Ingrese Nombre" required>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                  <i class="prefix material-icons">perm_identity</i>
                  <input name="apellido" id="apellido" class="full-width" type="text" placeholder="Ingrese Apellido" value="" title="Ingrese Apellido" required>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                  <i class="prefix material-icons">mail</i>
                  <input name="email" id="email" class="full-width" type="email" placeholder="Ingrese email" value="" title="Ingrese email" required>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                  <i class="prefix material-icons">lock</i>
                  <input name="password" id="password" class="full-width" type="password" placeholder="Ingrese contraseña" value="" title="Ingrese contraseña" required>
              </div>
          </div>
          <div class="form-group">
              <div class="input-group">
                  <i class="prefix material-icons">date_range</i>
                  <input name="birthday" id="birthday" class="full-width" type="date" value="" title="Ingrese su Fecha de Nacimiento">
              </div>
          </div>
          <div class="form-group">
              <div class="checkbox">
                  <input type="checkbox" id="inputCheckbox" name="remember" required>
                  <label for="inputCheckbox" title="Aceptar Terminos y Condiciones">Acepto los <a href="signup/conditions" target="_blank">Terminos y Condiciones</a></label>
              </div>
          </div>
          <button type="submit" class="btn" title="Registrar">Registrar</button>
        </form>
      </div>
    </div>

    <footer class="text-center" style="color: #4285F4; margin-top: 45px;">
      <p>Hospital de Niños Ricardo Gutierrez.</p>
      <p>Proyecto de Software &copy; 2017</p>
    </footer>
  </body>
</html>
