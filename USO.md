# Uso de la aplicación

Para el uso de la aplicación, se debe comprender que existen 3 roles básicos, 
permisos para acceder a diferentes secciones del sistema.

## Roles

A continuación se describiran los roles y sus permisos asociados:

- Administrador:
    - usuario_index
    - usuario_show
    - usuario_new
    - usuario_update
    - usuario_destroy
    - paciente_index
    - paciente_destroy
    - rol_index
    - rol_show
    - rol_new
    - rol_update
    - rol_destroy
- Recepcionista:
    - paciente_index
    - paciente_show
    - paciente_new
    - paciente_update
- Pediatra:
    - paciente_index
    - paciente_show
    - paciente_new
    - paciente_update

A modo de proveer una manera de recorrer  más facilmente el sistema para busqueda
de errores, o simplemente para conocer el sitio, se provee un rol más, denominado su
el cual cuenta con **todos** los permisos disponibles en el sistema.
Si bien con contar con el rol Administrador y cualquiera de los roles restantes
ya se cuenta con todos los permisos, se creo a modo de abstraerse de dicha asignación,
ya que esta puede cambiar con el tiempo.

 - Su:
    - usuario_index
    - usuario_show
    - usuario_new
    - usuario_update
    - usuario_destroy
    - paciente_index
    - paciente_show
    - paciente_new
    - paciente_update
    - paciente_destroy
    - rol_index
    - rol_show
    - rol_new
    - rol_update
    - rol_destroy

## Usuarios

Conociendo los roles, se cuenta con 5 usuarios básicos.

- Administrador:
    - rol: Administrador
    - usuario: admin
    - contraseña: admin
- Recepcionista:
    - rol: Recepcionista
    - usuario: recepcionista
    - contraseña: recepcionista
- Pediatra:
    - rol: Pediatra
    - usuario: pediatra
    - contraseña: pediatra
- Recepcionista Administrador:
    - rol: Recepcionista **y** Administrador
    - usuario: recepcionista-admin
    - contraseña: recepcionista-admin
- Medico Administrador:
    - rol: Pediatra **y** Administrador
    - usuario: medico-admin
    - contraseña: medico-admin
- Super Administrador:
    - rol: Administrador **y** Su
    - usuario: su
    - contraseña: su

Se decidió asignar el rol admninistrador extra al _Super Administrador_ por ciertas
secciones en el código en donde se requiere tener dicho rol, y no ciertos permisos.

## Errores

El sistema esta preparado para mostrar pantallas de error con los siguientes códigos:

- 403: Esto significa que su usuario no cuenta con el permiso necesario para acceder
a la página solicitada.
Normalmente bastaría con asignar un rol que cuente con el permiso necesario (ver
sección [roles](#roles)
- 404: Esto significa, como todos sabemos, que el recuerso buscado no se encuentra
disponible.
- 500: Este error es el mostrado cuando el sistema se encuentra en _Mantenimiento_
y va a ser el inicial durante estas semanas a modo de ilustración (ya que nos
encontramos en mantenimiento del sitio, cerrando ciertos módulos no?)
Para poder acceder al sitio libremente, se debe ingresar como **_Administrador_** 
o como **_Super Administrador_** (ver sección [usuario](#usuarios)) y desactivar
modo mantenimiento.