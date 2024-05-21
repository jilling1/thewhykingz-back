# laravel-thewhykingz

This template should help get you started developing with Laravel.

## Project Setup

Rename .env-example to .env
Instal MySQL database
Create a database with the name "thewhykingz"

```sh
composer install
```

```sh
php artisan migrate
```

```sh
php artisan db:seed --class=NewsItemSeeder
```

### Compile and Hot-Reload for Development

```sh
php artisan serve
```
