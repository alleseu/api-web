# Aplicación Web - Stack: PHP Slim 2 Framework + JS jQuery

* Autor: `Alejandro Alberto Sánchez Iturriaga`
* Fecha: `05-10-2021`

___
### Versión de Framework y lenguaje

* Slim Framework versión 2.6.3
* PHP versión 5.3 en adelante, funciona perfectamente incluso la versión 8.0.9

___
### Librerías instaladas

* jQuery versión 3.6.0
* Popper versión 1.16.1
* Bootstrap versión 4.6.0
* Chart-JS versión 3.5.1
* jQuery-validation versión 1.19.3
* DataTables
    * Styling framework: `Boostrap 4 versión 4.1.1`
    * Packages: `DataTables versión 1.10.24`
    * Extensions: `AutoFill versión 2.3.5`
    * Extensions: `Buttons versión 1.7.0`
    * Extensions: `JSZip versión 2.5.0`
    * Extensions: `Pdfmake versión 0.1.36`
    * Extensions: `DateTime versión 1.0.3`
    * Extensions: `FixedHeader versión 3.1.8`
    * Extensions: `Responsive versión 2.2.7`
    * Extensions: `RowGroup versión 1.1.2`
    * Extensions: `Scroller versión 2.0.3`
    * Extensions: `Select versión 1.3.3`

___
### Instrucciones para instalar la aplicación

* Clonar proyecto con el nombre `api-web`.
* Crear una base de datos en Mysql con el nombre `api-web`. Luego, debe importar el archivo `database.sql`, ubicado en el directorio `resource`.
* La configuración de la conexión a la base de datos se encuentra en el archivo `Settings.php`, ubicado en el directorio `src/App`.

___
### Configuración para servidor Nginx

* Esta es una configuración de host virtual Nginx de ejemplo para el dominio `http://localhost/`. Se espera conexiones entrantes HTTP en el puerto 80, y se supone un servidor PHP-FPM que se está ejecutando en el puerto `9002`.
* Se agregó la siguiente configuración en el archivo `nginx.conf`, dentro de server {}. Se adjunta el archivo completo en el directorio `resource`.

    ```text
    location /api-web {
        try_files $uri /api-web/index.php$is_args$args;

        ## Regular PHP processing.
        location ~ \.php$ {
            try_files $uri =404;
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            fastcgi_param SCRIPT_NAME $fastcgi_script_name;
            fastcgi_index index.php;
            fastcgi_pass 127.0.0.1:9002;
        }
    }
    ```

* Siguiendo el ejemplo, la url para acceder a la aplicación es `http://localhost/api-web`.

___
### Link de recursos

* [https://www.slimframework.com/]  Sitio oficial del framework Slim PHP.
* [https://www.slimframework.com/docs/v2/]  Sitio oficial del framework Slim PHP, para la documentación de la versión 2.
* [https://github.com/Seldaek/monolog/tree/1.x]  Biblioteca para registrar errores, que cumple con el estándar PSR-3.
* [https://github.com/Flynsarmy/Slim-Monolog]  Biblioteca que agrega soporte para iniciar Monolog en Slim 2 Framework.
* [https://jquery.com/]  Sitio oficial de la librería de JavaScript jQuery.
* [https://datatables.net/]  Sitio oficial de la librería de dataTables.
* [https://www.chartjs.org/docs/latest/]  Sitio oficial de la librería Chart-JS para la documentación.
