<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Ortho Studio Control de Citas 

## Dependencias

-  Se debe tener instalado [XAMPP](https://www.apachefriends.org/es/download.html "XAMPP") (versión **PHP** **8.2** o superior)

-  Se debe tener instalado [Composer](https://getcomposer.org/download/ "Composer")

  

## Como instalar en Local

1.  Clone  o  descargue  el  repositorio  a  una  carpeta  en  Local

  

1.  Abra  el  repositorio  en  su  editor  de  código  favorito  (**Visual  Studio  Code**)

  

1.  Ejecute  la  aplicación  **XAMPP**  e  inice  los  módulos  de  **Apache**  y  **MySQL**

  

1.  Abra  una  nueva  terminal  en  su  editor

  

1.  Compruebe  de  que  tiene  instalado  todas  dependencias  correctamente,  ejecute  los  siguientes  comandos:  **(Ambos  comandos  deberán  ejecutarse  correctamente  -  ejecutar  en  la  terminal)**

```bash

php  -v

```

```bash

composer  -v

```

  

1.  Ahora  ejecute  los  comandos  para  la  configuración  del  proyecto  (**ejecutar  en  la  terminal**):

  

-  Este comando nos va a instalar todas la dependencias de composer

```bash

composer install

```

-  En el directorio raíz encontrará el arhivo **.env.example**, dupliquelo, al archivo duplicado cambiar de nombre como **.env**, este archivo se debe modificar según las configuraciones de nuestro proyecto. Ahí se muestran como debería quedar

```bash

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=ortho_studio

DB_USERNAME=root

DB_PASSWORD=

```

-  Ejecutar el comando para crear la Key de seguridad

```bash

php artisan key:generate

```

- (Solo si el paso siguiente genera error) Ingrese al administrador de [PHP MyAdmin](http://localhost/phpmyadmin/) y cree una nueva base de datos, el nombre es opcional, pero por defecto nombrarla **ortho_studio**

  

-  Correr la migraciones del proyecto

```bash

php artisan migrate

```

-  Ejecute los seeders, esto creará un usuario administrador, puede revisar las credenciales en el archivo (**database/seeders/UserSeeder**)

```bash

php artisan db:seed

```

-  Corra comando para crear el enlace simbólico

```bash

php artisan storage:link

```
-  Si quiere ejecutar los trabajos (modo de desarrollo)

```bash

php artisan queue:listen

```

  -  Ejecute el proyecto (en otra terminal)

```bash

php artisan serve

```
