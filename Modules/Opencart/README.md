

# config

Add following to app/Consoel/Kernel.php and app/Http/Kernel.php.

```
    public function __construct($app, $events)
    {
        \Modules\Opencart\Bootstrap\LoadOpenCart::$insetMeToKernelBootstrappers->call($this);
        parent::__construct($app, $events);
    }
```

# start

```
# then you can use Models like Category defined in Modules\Opencart\Entities\
#      Category::where('category_id',20)->first()->products()->get()
php artisan tinker
```

If a class not found, run
```
composer dump-autoload
```

# Credit

Some models origin from 2014 [oney/opencart-laravel](https://github.com/oney/opencart-laravel) and 2016 [exfriend/laracart](https://github.com/exfriend/laracart) with modification for OpenCart 3.