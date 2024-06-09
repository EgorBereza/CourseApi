# Assignment

You have to build a CRUD API for the resource Course. The resource should be publicly
accessible, without any relationship.

Course database table should have:
- id
- title
- description
- status (Published,Pending)
- is_premium
- created_at
- deleted_at

You should provide database migrations for the schema.

Expected endpoints:
GET /courses
GET /courses/{id}
POST /courses
PUT /courses/{id}
DELETE /courses/{id}

Any external input should be validated.
Course entity business logic code base should be reusable and open for extension.

Open API documentation will be appreciated.

# Installation

# MySql Database Creation
- `CREATE USER 'egor'@'localhost' IDENTIFIED BY '12345';`
- `CREATE DATABASE schoox;`
- `GRANT ALL PRIVILEGES ON schoox.* TO 'egor'@'localhost';`
- `FLUSH PRIVILEGES;`

# Deployment
- `git clone https://github.com/EgorBereza/CourseApi.git`
- `composer install`
- `php artisan migrate --seed`
- `php artisan serve` (not need if Laravel herd is used)

# Run Tests
- `php artisan test`

# Swagger Api Documentation Genertion
- `php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"`
- `php artisan l5-swagger:generate`

# Notes

1) The api was developed and tested by using Laravel Herd + Local Mysql Server (https://herd.laravel.com)

2) Swagger will be accessible at http://your-domain/api/documentation after the generation

