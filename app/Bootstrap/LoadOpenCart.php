<?php

namespace App\Bootstrap;

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
        $this->loadAdminConfig($app);
    }

    protected function loadAdminConfig(\Illuminate\Foundation\Application $app)
    {
        $opencart_path = realpath(env('OPENCART_DIR'));
        if (!$opencart_path) {
            $this->writeErrorAndDie("env 'OPENCART_DIR' does not exist");
        }

        $opencart_admin_path = realpath(env('OPENCART_ADMIN_DIR'));
        if (!$opencart_admin_path) {
            $this->writeErrorAndDie("env 'OPENCART_ADMIN_DIR' does not exist");
        }


        try {
            require_once("$opencart_admin_path/config.php");
        } catch (\Exception $e) {
            $this->writeErrorAndDie("env('OPENCART_ADMIN_DIR') does not exist");
        }

        $this->checkMysqlExtension($app);

        $this->bindPathsInContainer($app, $opencart_path, $opencart_admin_path);
    }

    protected function checkMysqlExtension(\Illuminate\Foundation\Application $app)
    {
        if (!defined('DB_DRIVER'))
            $this->writeErrorAndDie('Const DB_DRIVER should be available.');


        if (strpos(DB_DRIVER, 'mysql') === false)
            $this->writeErrorAndDie('Database config should update in '
                . $app->configPath('database.php')
                . ', because OpenCart uses DB_DRIVER '
                . DB_DRIVER
                . ', instendof mysqli or pdo_mysql'
            );

        if (!extension_loaded('pdo_mysql'))
            $this->writeErrorAndDie('Php ext pdo_mysql not loaed, so you can not access db from Laravel.',
                false);

    }

    protected function bindPathsInContainer(Application $app, $opencart_path, $opencart_admin_path)
    {
        $app->instance('path.opencart', $opencart_path);
        $app->instance('path.opencartadmin', $opencart_admin_path);
    }

    /**
     * @param \Exception|string $e
     *
     * copy from: Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables
     */
    protected function writeErrorAndDie($e,$die=true)
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
