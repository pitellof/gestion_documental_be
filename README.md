# Capa de Datos

Este proyecto es generado utilizndo [Larave](https://laravel.com/docs/5.8) version 5.8.x.

## Objetivo del proyecto

Proveer un marco de trabajo que considere las mejores prácticas para el desarrollo de aplicaciones web seguras.

## Contenido

En este apartado se describe de forma general el contenido del proyecto.

### Prerequisitos

**Instalar:**

*Dependencias:*

* [GIT](https://git-scm.com/)   -   Contról de vesionamiento.
* [Composer](https://getcomposer.org/) -   Administrador de paquetes PHP.
* [Visual Code](https://code.visualstudio.com/) - IDE de desarrollo recomendada.

*Laravel:*

* [Larave](https://laravel.com/docs/5.8) -   Marco de trabajo para desarrollar RESTful API

### Librerías adiconadas al proyecto

* [Laravel Excel](https://laravel-excel.maatwebsite.nl/) - Librería para exportar información de tablas a formato Excel.
* [PhpSpreadSheet](https://phpspreadsheet.readthedocs.io/en/develop/) - Desarrollo base de Laravel Excel.
* [JWT Auth](https://tutsforweb.com/restful-api-in-laravel-56-using-jwt-authentication/) - Implementación del estandar industrial RFC 7519


### Módulos integrados al proyecto

* *Servicios:*
    * RESTful API protegido con JWT

## Instalación.

* Descargar la rama de desarrollo-2019 (Temporal hasta el primer Merge del proyecto a Master) mediante el uso de GIT.
* En el folder del proyecto ejecutar el comando :\> composer install y esperar a que finalice la instalación de las dependencias.
* En caso de necesitar actualizaciones ejecutar :\> composer update.
* Realizar una copia del archivo .env.example y renombrar a .env. En su interior configurar la conexión a la base de datos.
* Validar la configuración ejecutando :\> php artisan migrate, lo que debería generar las tablas básicas en la base de datos.
* Ejecutar :\> php artisan clear-compiled
* Ejecutar :\> php artisan jwt:secret
* Ejecutar :\> php artisan key:generate
* Ejecutar :\> php artisan optimize
* Ejecutar el comando :\> php artisan serv y visitar en el navegador la URL <http://localhost:8000> para comprobar el funcionamiento del marco de trabajo.