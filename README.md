### Prueba legops

Esta prueba esta hecha en laravel 8, para correr el proyecto localmente, realizar los siguientes pasos:

1- Clonar el proyecto 
```
git clone https://github.com/CesarGomez92/legops.git 
```
O descargar como zip.

2- En el archivo .env definir las siguientes variables
```
// .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=legops
DB_USERNAME=db username
DB_PASSWORD=db password

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=mailtrap username
MAIL_PASSWORD=mailtrap password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
MAIL_ADMIN_REPORTS=myadminemail@example.com
```
Este proyecto utiliza mailtrap para envio de correos, para esto se debe crear una cuenta en la siguiente direccion [https://mailtrap.io/](https://mailtrap.io/), clic en *my inbox* y en el dropdown de integrations seleccionar laravel. Utilizar estas credenciales en el archivo .env.

Tambien se usa MySQL el cual debe estar instalado en la maquina y se debe crear la base de datos manualmente de la siguiente manera:
```
mysql -uroot -p
password: mypassword
create database legops;
exit;
```

3- Ejecutar los siguientes comandos para instalar dependencias
```
composer install
npm install
```

4- Ejecutar migraciones 
```
php artisan migrate
php artisan categories:fill-data
```

5- Ejecutar el siguiente comando para generar los bundles de JavaScript
```
npm run dev
```

6- Subir el servidor de desarrollo local
```
php artisan serve
```

7- Abrir un navegador (Google Chrome de preferencia) y dirigirse a http://127.0.0.1:8000

