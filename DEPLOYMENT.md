# DEPLOYMENT

En este documento se van a especificar los pasos necesarios a seguir para pasar
de cualquiera de las ramas a la master y dejar la app funcionando en el server
lista para ser accedida por la [url principal](https://grupo5.proyecto2017.linti.unlp.edu.ar/)

Ya se han visto los pasos para levantar la app en ambito de desarrollo en el 
[archivo INSTALL](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/blob/master/INSTALL.md)
El paso siguiente es, luego de realizar cambios en dicha rama, deployar

En esta etapa, va a ser necesario posicionarse en la rama master y mergear con 
la rama deseada ejecutando el siguiente comando

```bash
$ git pull
$ git checkout master
$ git pull
$ git merge <rama_a_mergear>
```

_Procurar **SIEMPRE** contar con la última version de las ramas involucradas para evitar inconvenientes_

Luego, va a ser necesario modificar ciertos archivos de configuración con los datos
del servidor, como son el [archivo de configuración de la base de datos](https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5/blob/master/config/db.json)

Se sabe que en el ambito de desarrollo, la base de datos se encuentra dockerizada
y accesible mediante la ip 172.17.0.1 o por su alias "local.docker".
En este nuevo ambito, es necesario configura la ip de la base de datos con la 
utilizada en el servidor, la cual es 127.0.0.1 o 'localhost', especificando además
el puerto estandar de sql, 3306.
Una muestra del archivo sería la siguiente:

```json
{
  "database": {
    "host": "localhost",
    "user": "root",
    "pass": "",
    "name": "grupo5",
    "port": 3306,
    "protocol": "TCP",
    "driver": "mysql"
  }
}
```

Además es necesario cambiar los tags utilizados por composer para bajar el framework
[MBHFramework](https://github.com/MBHFramework), por los tags estables.
Los mismos serán la última version de la rama 5.6 presentada por [packagist](https://packagist.org/packages/mbh-framework/)
Quedando algo del estilo:

```json
{
    "name": "proyecto2017/grupo5",
    "license": "MIT",
    "authors": [
        {
            "name": "Ulises Jeremias Cornejo Fandos",
            "email": "ulisescf.24@gmail.com"
        },
        {
            "name": "Juan Cruz Ocampos",
            "email": "ocamposjuancruz23@gmail.com"
        },
        {
            "name": "Lucas Di Cunzolo",
            "email": "ldicunzolo@cespi.unlp.edu.ar"
        }
    ],
    "description": "",
    "repository": {
        "type": "git",
        "url": "git+https://gitlab.catedras.linti.unlp.edu.ar/proyecto2017/grupo5.git"
    },
    "require": {
        "php": "^5.6 || ^7.0",
        "twig/twig": "^1",
        "mbh-framework/rest": "v5.6",
        "mbh-framework/mvc": "v5.6",
        "mbh-framework/firewall": "v5.6"
    }
}
```

_Tener en cuenta que pueden agregarse dependencias nuevas, o cambiar la version del tag en cuestion_ 