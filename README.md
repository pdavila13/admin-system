## About This Projects

This project is made in Laravel version 10. In this project, I used an Admin LTE with a breeze installation. Users do have not to worry about assets & folder paths for the admin side. Created for basic e-commerce project admin.Added the basic modules. Don't forget to give star to this repository ⭐.

## Installation & usage
- For Install you have to clone this repo or you can fire this command as well.

```php
git clone https://github.com/pdavila13/admin-system.git
```

- Go into folder

```php
cd admin-system
```

- After the installation you have to update the vendor folder you can update the vendor folder using this command.

```php
composer update
```

- After the updation you have to create the ```.env``` file via this command.

```php
cp .env.example .env
```

- Now you have to generate the product key.

```php
php artisan key:generate
```

- Now migrate the tables & seed the database.

```php
php artisan migrate --seed
```

- We are done here. Now you have to just serve your project.

```php
php artisan serve
```