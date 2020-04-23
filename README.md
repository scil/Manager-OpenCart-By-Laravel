Access and control OpenCart 3 from Laravel.

Thanks for [nwidart/laravel-modules](https://github.com/nWidart/laravel-modules).

# Features

- use OpenCart front or admin config by add a bootstrap `Modules\Opencart\Bootstrap\LoadOpenCart.php`
- bind something to Container: `opencart.admin`, `opencart.path`, `opencart.apppath`, and `opencart.adminpath`.
- Communicate with opencart database with Laravel DB builder and Elequent.  how? to define some Model classes for opencart database.

# Env

edit .env

# Start

`composer dump-autoload`

shell
```
# then: Category::all()
artisan tinker
```
