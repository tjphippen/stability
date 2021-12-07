<?php

declare(strict_types=1);

namespace Tjphippen\Laddr;

use GitGlacier\Glacial\Console\RoutesGenerateCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;

class LaddrServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
//        $this->publishes([
//            __DIR__ . '/config/glacial.php' => config_path('glacial.php'),
//        ]);
//        // Register Extended Route ResourceRegistrar (replace w/Middleware?)
//        $registrar = new Routing\ResourceRegistrar($this->app['router']);
//        $this->app->bind('Illuminate\Routing\ResourceRegistrar', function () use ($registrar) {
//            return $registrar;
//        });
//
//        $this->app->singleton(
//            \Illuminate\Foundation\Exceptions\Handler::class,
//            Handler::class
//        );
    }

    /**
     * Bootstrap the application services.
     * @param Filesystem $filesystem
     * @param Router $router
     * @return void
     */
//    public function boot(Filesystem $filesystem, Router $router)
//    {
//        $this->app->bind('glacial', function () use ($router) {
//            return new Routing\Route($router);
//        });
//        if ($this->app->runningInConsole()) {
//            $this->commands(RoutesGenerateCommand::class);
//        }
//        foreach ($filesystem->files(base_path() . '/routes') as $routeFile) {
//            if (Str::startsWith($routeFile->getFilename(), 'glacial.')) {
//                $this->loadRoutesFrom($routeFile);
//            }
//        }
//    }
}
