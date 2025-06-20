# CitaTallerBack
Backend de la aplicación de gestión de citas para talleres mecánicos. Desarrollado con **Laravel** y autenticación basada en **JWT**

Este proyecto se complementa con el frontend disponible en el repositorio: CitaTallerFront.
# Tecnología utilizadas
- PHP >= 8.1
- Composer
- Laravel 12
- Postgres

# Instalación
Clonar el repositorio:
```
git clone https://github.com/usuario/CitaTallerBack.git
cd CitaTallerBack
```
Instalar dependencias:
```
composer install
```
Crear archivo .env
```
cp .env.example .env
```
Generar la clave de la app
```
php artisan key:generate
```
Migraciones y seeders (La contraseña de los seeders es password)
```
php artisan migrate
php artisan db:seed
```
Clave de JWT
```
php artisan jwt:secret
```
Servidor de desarrollo
```
php artisan serve
```
