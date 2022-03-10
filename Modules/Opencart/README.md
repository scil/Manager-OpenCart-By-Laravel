

# How to config for this module

Add following to app/Consoel/Kernel.php and app/Http/Kernel.php.

```
    public function __construct($app, $events)
    {
        \Modules\Opencart\Bootstrap\LoadOpenCart::$insetMeToKernelBootstrappers->call($this);

        parent::__construct($app, $events);
    }
```

# Start

```
# then you can use Models like Category defined in Modules\Opencart\Entities\
#      Category::where('category_id',20)->first()->products()->get()
php artisan tinker
```

If a class not found, run
```
composer dump-autoload
```

# Features

- use OpenCart front or admin config by add a bootstrap `Modules\Opencart\Bootstrap\LoadOpenCart.php`
- bind something to Container: `opencart.admin`, `opencart.path`, `opencart.apppath`, and `opencart.adminpath`.
- Communicate with opencart database with Laravel DB builder and Elequent.  how? to define some Model classes for opencart database.

# Todo
- [ ] https://github.com/beyondit/opencart-test-suite
- [ ] https://github.com/opencorero/opencore

# Credit

Some models origin from 2014 [oney/opencart-laravel](https://github.com/oney/opencart-laravel) and 2016 [exfriend/laracart](https://github.com/exfriend/laracart) with modification for OpenCart 3.
