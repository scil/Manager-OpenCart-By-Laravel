<?php

namespace Modules\Opencart\Bootstrap;

use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\Console\Output\ConsoleOutput;


class LoadOpenCart
{
    static public $insetMeToKernelBootstrappers;

    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        $this->loadConfig($app);
    }

    protected function loadConfig(\Illuminate\Foundation\Application $app)
    {
        $opencart_path = realpath(env('OPENCART_DIR'));
        if (!($opencart_path && is_file("$opencart_path/composer.json"))) {
            $this->writeMsgOrDie("env 'OPENCART_DIR' does not exist");
        }

        $opencart_app_path = realpath(env('OPENCART_APPLICATION_DIR'));
        if (!$opencart_app_path) {
            $this->writeMsgOrDie("env 'OPENCART_APPLICATION_DIR' does not exist");
        }


        try {
            require_once("$opencart_app_path/config.php");
        } catch (\Exception $e) {
            $this->writeMsgOrDie("env('OPENCART_APPLICATION_DIR') does not exist");
        }

        $this->checkMysqlExtension($app);

        $this->bindInContainer($app, $opencart_path, $opencart_app_path);
    }

    protected function checkMysqlExtension(\Illuminate\Foundation\Application $app)
    {
        if (!defined('DB_DRIVER'))
            $this->writeMsgOrDie('Const DB_DRIVER should be available.');


        $db = array(
            'mysql',
            'mysqli',
            'pgsql',
            'pdo'
        );
        if (!in_array(DB_DRIVER, $db))
            $this->writeMsgOrDie('DatabaseServiceProvider.php should update in '
                . ' Modules\Opencart\Providers, because OpenCart uses DB_DRIVER '
                . DB_DRIVER
                . ', instendof '
                . implode(' ', $db)
            );

        if (!extension_loaded('pdo_mysql'))
            $this->writeMsgOrDie('Php ext pdo_mysql not loaed, so you can not access db from Laravel.',
                false);

    }

    protected function bindInContainer(Application $app, $opencart_path, $opencart_app_path)
    {
        // DIR_CATALOG only defined in admin/config.php
        $is_admin = defined('DIR_CATALOG');

        // this check would invalid if laravel and OpenCart server run in different os, like windows and virtual host
//        if($is_admin && (DIR_APPLICATION !== $opencart_app_path)){
//            $this->writeMsgOrDie('DIR_APPLICATION in config.php of admin should is '
//                . $opencart_app_path
//            );
//        }

        $this->writeMsgOrDie('OpenCart Application: '
            . ($is_admin ? 'admin' : 'catalog'),
            false);

        $app->instance('opencart.admin', $is_admin);

        $app->instance('opencart.path', $opencart_path);
        $app->instance('opencart.apppath', $opencart_app_path);
        $app->instance('opencart.adminpath', $is_admin ? $opencart_app_path : null);

    }

    /**
     * @param \Exception|string $e
     *
     * copy from: Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::writeErrorAndDie
     */
    protected function writeMsgOrDie($e, $die = true)
    {
        $output = (new ConsoleOutput)->getErrorOutput();

        $output->writeln($e instanceof \Exception ? $e->getMessage() : $e);

        $die && die(1);
    }

}

LoadOpenCart::$insetMeToKernelBootstrappers = function () {

    if (array_search(\Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
            $this->bootstrappers) != 0) {
        dd('bootstrappers of Laravel Http or Console kernels changed!');
    }

    array_splice($this->bootstrappers, 1, 0, LoadOpenCart::class);
//    dd($this->bootstrappers);
};
