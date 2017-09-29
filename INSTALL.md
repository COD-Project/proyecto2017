# Instalación

En este documento se van a especificar todo lo requerido para tener la app del Hospital de Niños Ricardo Gutiérrez funcionando.

## Requerimientos
- Mínimos:
    - Php 5.6.30 (cualquiera perteneciente a la rama 5.6)
    - Composer 1.2.2 o superior
    - MariaDB 10.1.26 o superior
    - Apache 2.4.10 o superior
    - npm 5.4.2 o superior
    - [direnv](https://github.com/direnv/direnv) 2.4.0 o superior
- Recomendaciones:
    - Usar las imagenes docker de php, php-apache, mysql y composer (se explicará más adelante como instalarlas y configurarlas)
    - Usar [nvm](https://github.com/creationix/nvm) y desde nvm instalar node y npm (la instalación se encuentra explicada en el repositorio de nvm)

## Instalación del ambiente
_si le falta cumplir alguno de los requerimientos, seguir a la siguiente sección_

Instalación de los componentes necesarios usando composer y npm:
```bash
$ npm install
```

Con esto, se procederá a crear la carpeta vendor, la cual contendrá los módulos php y node.

Para el desarrollo de la aplicación, se utilizaron imágenes de docker de php:5.6.30-cli y php:5.6.30-apache, por lo que se recomienda el uso de las mismas. Por lo que se recomienda tener instalado docker.

_Se recomienda agregar su usuario al grupo de docker para evitar la necesidad de ejecutar docker con sudo. Esto se puede hacer ejecutando:_

```bash
$ sudo usermod -a -G docker $USER
```


### Instalación de las imagenes de php y mysql de docker


Para instalar las imágenes de chrodriguez/php-5.6:cli-latest y chrodriguez/php-5.6:apache-latest se tiene que ejecutar los siguientes comandos:

```bash
$ docker pull chrodriguez/php-5.6:cli-latest
$ docker pull chrodriguez/php-5.6:apache-latest
$ docker pull mysql
```
_para más información, se puede consultar el [repo de chrodriguez](https://hub.docker.com/r/chrodriguez/php-5.6/)_


_Además, se recomienda instalar la imagen docker de composer_

```bash
$ docker pull composer
```


Luego se debe configurar el ambiente para que se ejecute la imagen de php descargada para esto, se debe crear en el directorio raíz del proyecto el archivo .envrc con el siguiente contenido:

```bash
export PATH=$HOME/bin:$PATH
export PHP_CLI_DOCKER_IMAGE=chrodriguez/php-5.6:cli-latest
export PHP_SERVER_DOCKER_IMAGE=chrodriguez/php-5.6:apache-latest
export MYSQL_DOCKER_IMAGE=mysql
export PHP_SERVER_DOCKER_LOGS="$PWD/var/logs/apache.logs"
export PHP_SERVER_DOCKER_RUN_OPTIONS='--add-host local.docker:172.17.0.1 -e APACHE_RUN_USER=<your_username> -e APACHE_RUN_GROUP=<your_user_group> -v <your_home>/bin/etc/docker/php/php.ini:/usr/local/etc/php/conf.d/<your_user>.ini:ro'
```

_Para el correcto funcionamiento del archivo .envrc es necesario contar con [**direnv**](https://github.com/direnv/direnv)_

_Ademas, **cada vez que se modifique** se debe ejecutar:_

```bash
$ direnv allow
```

### Recomendaciones

Para proveer un entorno más amigable para el desarrollo, se proveen 6 scripts que funcionan a forma de wrapper a los comandos de docker.
Junto con estos scripts se puede pedir declarar ciertas variables de ambiente.
Todos los scripts aqui mostrados, fueron publicados en la sección [snippets](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/snippets) del repositorio

[Archivo php](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/snippets/2/raw?inline=false)
```bash
#!/bin/bash

set -e 

[ -z "$PHP_CLI_DOCKER_IMAGE" ] && ( echo You must set PHP_CLI_DOCKER_IMAGE environment variable ; exit 1)

PHP_OPTIONS=${PHP_OPTIONS:- -d 'date.timezone=America/Argentina/Buenos_Aires' -d memory_limit=512M}
PHP_CLI_DOCKER_RUN_OPTIONS=${PHP_CLI_DOCKER_RUN_OPTIONS:-'--add-host local.docker:172.17.0.1'}

docker run --rm -it -u `id -u $USER`:`id -g $USER` -v "`pwd`:`pwd`" -w "`pwd`" $PHP_CLI_DOCKER_RUN_OPTIONS $PHP_CLI_DOCKER_IMAGE $PHP_OPTIONS $@
```

[Archivo php-server](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/snippets/3/raw?inline=false)
```bash
#!/bin/bash

set -e 

[ -z "$PHP_SERVER_DOCKER_IMAGE" ] && ( echo You must set PHP_SERVER_DOCKER_IMAGE environment variable ; exit 1)

[ "$1" = "-v" ] && ( echo $PHP_SERVER_DOCKER_IMAGE; exit 1)

PHP_SERVER_PORT=$1

[ -z "$PHP_SERVER_PORT" ] && ( echo You must specify wich port to use as parameter; exit 1)

#if $1 was set, the remove it
shift

[ "$PHP_SERVER_PORT" -lt 1024 ] && (echo port must be greater than 1024; exit 1)

PHP_SERVER_DOCKER_RUN_OPTIONS=${PHP_SERVER_DOCKER_RUN_OPTIONS:-'--add-host local.docker:172.17.0.1'}

docker run --rm -p ${PHP_SERVER_PORT}:80 -v /etc/passwd:/etc/passwd:ro -v /etc/group:/etc/group:ro -v "`pwd`:`pwd`" -e "APACHE_DOCUMENT_ROOT=`pwd`" -w "`pwd`" $PHP_SERVER_DOCKER_RUN_OPTIONS $PHP_SERVER_DOCKER_IMAGE $@ |& tee -a $PHP_SERVER_DOCKER_LOGS
```

[Archivo composer](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/snippets/4/raw?inline=false)
```bash
#!/bin/bash

docker run --rm --interactive --tty --volume $PWD:/app composer $@
```

[Archivo mysql-server](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/snippets/5/raw?inline=false)
```bash
#!/bin/bash

set -e

[ "$1" = "stop" ] && ( docker stop mysql-server; exit 1)

[ -z "$MYSQL_DOCKER_IMAGE" ] && ( echo You must set MYSQL_DOCKER_IMAGE environment variable ; exit 1)

[ "$1" = "-v" ] && ( echo $MYSQL_DOCKER_IMAGE; exit 1)

MYSQL_DOCKER_RUN_OPTIONS=${MYSQL_DOCKER_RUN_OPTIONS:-'--add-host local.docker:172.17.0.1'}

docker run --rm --name mysql-server -e MYSQL_ALLOW_EMPTY_PASSWORD='yes' -p 3307:3306 -v mysql-data:/var/lib/mysql -d $MYSQL_DOCKER_RUN_OPTIONS $MYSQL_DOCKER_IMAGE $@
```

[Archivo mysql-client](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/snippets/6/raw?inline=false)
```bash
#!/bin/bash

set -e 

[ -z "$MYSQL_DOCKER_IMAGE" ] && ( echo You must set MYSQL_DOCKER_IMAGE environment variable ; exit 1)

[ "$1" = "-v" ] && ( echo $MYSQL_DOCKER_IMAGE; exit 1)

MYSQL_SERVER_DOCKER=`docker ps -f name=mysql-server -f status=running --format {{.ID}}`

[ -z $MYSQL_SERVER_DOCKER ] && ( echo No mysql-server found ; exit 1)

docker exec -it $MYSQL_SERVER_DOCKER mysql $@
```

[Archivo phpmyadmin](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/snippets/7/raw?inline=false)
```bash
#!/bin/bash

set -e

[ "$1" = "stop" ] && ( docker stop phpmyadmin; exit 1)

[ -z "$PHPMYADMIN_DOCKER_IMAGE" ] && ( echo You must set PHPMYADMIN_DOCKER_IMAGE environment variable ; exit 1)

[ "$1" = "-v" ] && ( echo $PHPMYADMIN_DOCKER_IMAGE; exit 1)

MYSQL_SERVER_DOCKER=`docker ps -f name=mysql-server -f status=running --format {{.ID}}`

[ -z $MYSQL_SERVER_DOCKER ] && ( echo No mysql-server found ; exit 1)

PHPMYADMIN_PORT=$1

[ -z "$PHPMYADMIN_PORT" ] && ( echo You must specify wich port to use as parameter; exit 1)

shift

[ "$PHPMYADMIN_PORT" -lt 1024 ] && (echo port must be greater than 1024; exit 1)

docker run --rm --name phpmyadmin -d --link mysql-server:db -p 8080:80 phpmyadmin/phpmyadmin $@
```

Y un archivo de configuracion en $HOME/bin/etc/docker/php/php.ini:
```
date.timezone=America/Argentina/Buenos_Aires;
memory_limit=512M;
```

Con esto se debería contar con todo lo necesario para levantar la aplicación ejecutando en el directorio raíz del proyecto:

```bash
$ start_app
```

o se puede optar por levantar los servicios por separado ejecutando

```bash
$ mysql-server # Si no se encuentra el servicio ya corriendo
$ phpmyadmin <puerto> # Si se desea tener phpmyadmin y no se encuentra el servicio corriendo, escuchando en el puerto <puerto> (ejecución opcional)
$ php-server <puerto> # Se inicia el servidor apache escuchando en el puero <puerto>
```