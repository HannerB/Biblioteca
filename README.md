
```

- Instalamos las librería mediante Composer

```
composer install
```

- Creamos el archivo de variables de entorno

```
cp .env.example .env
```

- Editamos nuestro archivo de acuerdo a la BD que tenemos localmente

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

- Creamos la key que usará nuestra aplicación.

```
php artisan key:generate
```

- Creamos nuestra BD y ejecutamos la migración

```
php artisan migrate --seed
```

- Finalmente instalamos dependencias Javascript y levantamos nuestra aplicación

```
yarn && yarn dev
```


