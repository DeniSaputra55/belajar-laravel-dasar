<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
   public function testDependency()
   {
    $foo1 = $this->app->make(Foo::class); // new foo()
    $foo2 = $this->app->make(Foo::class); //new Foo()

    self::assertEquals('Foo', $foo1->foo());
    self::assertEquals('Foo', $foo2->foo());
    self::assertNotSame($foo1, $foo2);
   }

   //bind function
   public function testBind()
   {
    //$person = $this->app->make(Person::class); // new Person()
    //self::assertNotNull($person);
    $this->app->bind(Person::class, function ($app){
        return new Person("Eko", "Khannedy");
    });

    $person1 = $this->app->make(Person::class);
    $person2 = $this->app->make(Person::class);

    self::assertEquals("eko", $person1->firstName);
    self::assertEquals("eko", $person2->firstName);
    self::assertNotSame($person1, $person2);
   }
   //kode instance
   public function testInstance()
    {
        $person = new Person("Eko", "Khannedy");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person
        $person3 = $this->app->make(Person::class); // $person
        $person4 = $this->app->make(Person::class); // $person

        self::assertEquals('Eko', $person1->firstName);
        self::assertEquals('Eko', $person2->firstName);
        self::assertSame($person1, $person2);
    }
    //singleton
    public function testDependencyInjection()
    {
        //kode dependency injection
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });
        //dependency injectio closure
        $this->app->singleton(Bar::class, function ($app){
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }
    //test hello service
    public function testInterfaceToClass()
    {
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo Eko', $helloService->hello('Eko'));
    }
}
