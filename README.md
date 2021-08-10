# Lumen PHP Framework

Starter Laravel Lumen Framework is a starter rest api already integrate with jwt and Spatie Package for RBAC.
- Lumen (8.2.4) (Laravel Components ^8.0)

Quick start:
- Clone the repository
- run command: composer install
- Configurate .env file
- run command: 
    - php artisan jwt:secret
    - php artisan migrate
    - php artisan db:seed

User:
   - username: admin@gmail.com => pass: 123456789  Role => admin
   - username: user@gmail.com => pass: 123456789   Role => user

Url (POST):
   - localhost:8000/register
   - localhost:8000/login
   - localhost:8000/logout

Tes Controller for Role As Admin
   - localhost:8000/tes  => (this route ellow for access with admin user)

## Official Documentation

- Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).
- Documentation for the JWT can be found on the [Jwt website](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/).

## Contributing

mgafur
