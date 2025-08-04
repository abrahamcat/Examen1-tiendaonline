DATOS DEL PROYECTO:
Desarrollador:  Abraham Catacora Flores
Proyecto:       Tienda Online
Materia:        Taller de Aplicaciones en Internet
Docente:        Victor Hugo Perez Rojas

TECNOLOGIAS UTILIZADAS:
- Laravel Framework 12.21.0
- Laravel Sanctum v4.2.0
- Visual Studio Code 1.102.3
- MySQL 15.1
- Postman 11.55.3
- Xampp Control Panel v3.3.0
- PHP 8.2.12
- Composer 2.8.10
- Github git version 2.50.1
- Trello (Gestor de Proyecto)

INSTALACION Y PASOS:
- Se creo el repositorio en GitHub y se clono el proyecto con nombre Examen1-tiendaonline.
    https://github.com/abrahamcat/Examen1-tiendaonline.git
- Se creo la gestion de proyectos en TRELLO: "Proyecto Tienda Online"
    https://trello.com/invite/b/688fb9bba91e98d5291498ad/ATTI9c7d329cce28f5cb2906523554a48b15D2DF5AC1/proyecto-tienda-online
- Se creo el proyecto en Laravel:
    composer create-project laravel/laravel Examen1-nombretienda cd Examen1-nombretienda
- Se instalo Composer: composer install
- Se instalo y configuro LAravel SAnctum:
    composer require laravel/sanctum
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    php artisan migrate
- Se creo la Base de datos en phpMyAdmin con el nombre: "tienda_online-bd"
- Se configuro el archivo .env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=tienda_online_db
    DB_USERNAME=root
    DB_PASSWORD=
- Se creo las Migraciones y Modelos para: MARCA y PRODUCTO:
    php artisan make:model Marca –m
    php artisan make:model Producto -m
- Se editaron y ejecutaron las Migraciones: 
    php artisan migrate
- Se inicio el servidor de desarrollo:
    php artisan serve
    http://localhost:8000
- Se crearon los Controladores:
    php artisan make:controller Api/AuthController
    php artisan make:controller Api/MarcaController –api
    php artisan make:controller Api/ProductoController --api
- Se configuraron los Controladores:
    AuthController.php
    MarcaController.php
    ProductoController.php
- Instalamos y configuramos las rutas de la API:
    php artisan install:api

REALIZANDO PRUEBAS EN POSTMAN
- Registramos 1 usuario con POST:
    http://localhost:8000/api/register
        {
        "name": "Abraham Test",
        "email": "abraham@test.com",
        "password": "12345678",
        "password_confirmation": "12345678"
        }
- Registramos el Login con POST:
    http://localhost:8000/api/login
        {
        "email": "abraham@test.com",
        "password": "12345678"
        }
- Se genero el Token de seguridad:
    {
        "success": true,
        "message": "Login exitoso",
        "user": {
            "id": 1,
            "name": "Abraham Test",
            "email": "abraham@test.com",
            "email_verified_at": null,
            "created_at": "2025-08-03T23:47:59.000000Z",
            "updated_at": "2025-08-03T23:47:59.000000Z"
        },
        "token": "2|6JQUz0w3H0OWztoK0P1wisHKgsvvLUUa8Uz3B1euf70e1c5b",
        "token_type": "Bearer"
    }
- Registramos una Marca
    http://localhost:8000/api/marcas
        {
        "nombre": "Xiaomi"
        }
- Consultamos las marcas registradas con GET:
    http://localhost:8000/api/marcas
        resultado:
        {
        "success": true,
        "message": "Marcas obtenidas exitosamente",
        "data": [
            {
            "id": 1,
            "nombre": "Samsung",
            "created_at": "2025-08-04T00:43:41.000000Z",
            "updated_at": "2025-08-04T00:43:41.000000Z",
            "productos": []
            },
            {
            "id": 2,
            "nombre": "Xiaomi",
            "created_at": "2025-08-04T00:54:57.000000Z",
            "updated_at": "2025-08-04T00:54:57.000000Z",
            "productos": []
            }
        ]
        }
- Consultamos una sola marca con GET:
    http://localhost:8000/api/marcas/1
        resultado:
        {
        "success": true,
        "message": "Marca obtenida exitosamente",
        "data": {
            "id": 1,
            "nombre": "Samsung",
            "created_at": "2025-08-04T00:43:41.000000Z",
            "updated_at": "2025-08-04T00:43:41.000000Z",
            "productos": []
            }
        }
- Realizamos cambios en nombre de Marca con PUT:
    http://localhost:8000/api/marcas/1
        {
        "nombre": "Samsung Electronics"
        }
- Registramos un producto con POST:
        {
        "nombre": "Galaxy S24",
        "precio": 999.99,
        "marca_id": 1
        }
- Se consulto el producto y la marca con GET:
    http://localhost:8000/api/productos
        resultado:
        {
        "success": true,
        "message": "Productos obtenidos exitosamente",
        "data": [
            {
            "id": 1,
            "nombre": "Galaxy S24",
            "precio": "999.99",
            "marca_id": 1,
            "created_at": "2025-08-04T01:03:39.000000Z",
            "updated_at": "2025-08-04T01:03:39.000000Z",
            "marca": {
                "id": 1,
                "nombre": "Samsung Electronics",
                "created_at": "2025-08-04T00:43:41.000000Z",
                "updated_at": "2025-08-04T01:00:24.000000Z"
                }
            }
            ]
        }
