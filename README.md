# Instalación para seguir el [tutorial](https://laraveleando.dev/posts/crea-un-menu-dinamico-con-roles-y-permisos-en-laravel)
- Clonar el repositorio

```
git clone git@github.com:javierpomachagua/laraveleando-roles-permisos.git
```

- Ingresamos a la carpeta

```
cd laraveleando-roles-permisos
```

- Nos vamos a la rama starter

```
git checkout starter
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
DB_DATABASE=laraveleando_roles_permisos
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

- Nuestra pantalla inicial se verá de la siguiente manera

<img width="1275" alt="image" src="https://user-images.githubusercontent.com/7298734/235327339-eedfb923-bb84-4824-afd2-58ff324098d8.png">
