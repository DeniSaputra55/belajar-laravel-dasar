<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

//deferabble provider
class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    //singleton properties
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];
    public function register()
    {
        // echo "FooBarServiceProvider";
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app){
            return new Bar($app->make(Foo::class));
        });
    }
    public function boot()
    {
        //
    }
    public function provides()
    {
        return [HelloService::class, Foo::class, Bar::class];
    }
}
