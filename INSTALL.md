# Instalación

En este documento se van a especificar todo lo requerido para tener la app del Hospital de Niños Ricardo Gutiérrez funcionando.

## Requerimientos
- Mínimos:
    - Php 5.6.30 (cualquiera perteneciente a la rama 5.6)
    - Composer 1.2.2 o superior
    - MariaDB 10.1.26 o superior
    - Apache 2.4.10 o superior
    - npm 5.4.2 o superior
- Recomendaciones:
    - Usar las imagenes docker de php, php-apache y composer (se explicará más adelante como instalarlas y configurarlas)
    - Usar [nvm](https://github.com/creationix/nvm) y desde nvm instalar node y npm (la instalación se encuentra explicada en el repositorio de nvm)

## Instalación del ambiente
_si le falta cumplir alguno de los requerimientos, seguir a la siguiente sección_

Instalación de los componentes necesarios usando composer y npm:
```bash
npm start
```

Con esto, se procederá a crear la carpeta vendor, la cual contendrá los módulos php y node.

Para el desarrollo de la aplicación, se utilizaron imágenes de docker de php:5.6.30-cli y php:5.6.30-apache, por lo que se recomienda el uso de las mismas. Por lo que se recomienda tener instalado docker.

_Se recomienda agregar su usuario al grupo de docker para evitar la necesidad de ejecutar docker con sudo. Esto se puede hacer ejecutando:_

```bash
sudo usermod -a -G docker $USER
```


### Instalación de las imagenes de php de docker


Para instalar las imágenes de php:5.6.30-cli y php:5.6.30-apache se tiene que ejecutar los siguientes comandos:

```bash
docker pull php:5.6.30-cli
docker pull php:5.6.30-apache
```
_Además, se recomienda instalar la imagen docker de composer_

```bash
docker pull composer
```


Luego se debe configurar el ambiente para que se ejecute la imagen de php descargada para esto, se debe crear en el directorio raíz del proyecto el archivo .envrc con el siguiente contenido:

```bash
export PATH=$HOME/bin:$PATH
export PHP_CLI_DOCKER_IMAGE=<your_php_docker_image> # ie: 'php:5.6.30-cli' between single quotes
export PHP_SERVER_DOCKER_RUN_OPTIONS='--add-host local.docker:172.17.0.1 -e APACHE_RUN_USER=$USER -e APACHE_RUN_GROUP=$USER -v $HOME/bin/etc/docker/php/php.ini:/usr/local/etc/php/conf.d/$USER.ini:ro'
```

Ademas se debe contar con tres scripts en el directorio $HOME/bin:

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

PHP_SERVER_PORT=$1

[ -z "$PHP_SERVER_PORT" ] && ( echo You must specify wich port to use as parameter; exit 1)

#if $1 was set, the remove it
shift

[ "$PHP_SERVER_PORT" -lt 1024 ] && (echo port must be greater than 1024; exit 1)

PHP_SERVER_DOCKER_IMAGE=${PHP_SERVER_DOCKER_IMAGE:-php:5.6.30-apache}
PHP_SERVER_DOCKER_RUN_OPTIONS=${PHP_SERVER_DOCKER_RUN_OPTIONS:-'--add-host local.docker:172.17.0.1'}

docker run --rm -p ${PHP_SERVER_PORT}:80 -v /etc/passwd:/etc/passwd:ro -v /etc/group:/etc/group:ro -v "`pwd`:`pwd`" -e "APACHE_DOCUMENT_ROOT=`pwd`" -w "`pwd`" $PHP_SERVER_DOCKER_RUN_OPTIONS $PHP_SERVER_DOCKER_IMAGE $@
```

[Archivo composer](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/snippets/4/raw?inline=false)
```bash
#!/bin/bash

docker run --rm --interactive --tty --volume $PWD:/app composer $@
```

Y un archivo de configuracion en $HOME/bin/etc/docker/php/php.ini:
```
date.timezone=America/Argentina/Buenos_Aires;
memory_limit=512M;
```

Con esto se debería contar con todo lo necesario para levantar la aplicación ejecutando:

```bash
php-server <server_port>
```