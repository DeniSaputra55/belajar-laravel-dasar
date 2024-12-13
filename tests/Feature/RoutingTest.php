<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function testGet()
    {
        $this->get('/pzn')
        ->assertStatus(200)
        ->assertSeeText('Hello Programmer Zaman Now');
    }

    public function testRedirect() 
    {
        $this->get('/youtube')
        ->assertRedirect('/pzn');
    }

    //fallback route
    public function testFallback()
    {
        $this->get('/tidakada')
        ->assertSeeText('404 by Programmer Zaman Now');

        $this->get('/tidakadalagi')
        ->assertSeeText('404 by Programmer Zaman Now');

        $this->get('/ups')
        ->assertSeeText('404 by Programmer Zaman Now');
    }

    //test route parameter
    public function testRouteParameter()
    {
        $this->get('/products/1')
        ->assertSeeText('Product 1');

        $this->get('/products/2')
        ->assertSeeText('Product 2');

        $this->get('/products/1/items/XXX')
        ->assertSeeText('Product 1, Item XXX');

        $this->get('/products/2/items/XXX')
        ->assertSeeText('Product 2, Item XXX');
    }

    //route regular expression contraint
    public function testRouteParameterRegex()
    {
        $this->get('/categories/100')
        ->assertSeeText('Category 100');

        $this->get('/categories/eko')
        ->assertSeeText('404 by Denis');
    }

    //optional route paramter
    public function testRouteParameterOptional()
    {
        $this->get('/users/Khannedy')
        ->assertSeeText('User denis');

        $this->get('/users/')
        ->assertSeeText('User 404');
    }

    //routing conflict
    public function testRouteConflict()
    {
        $this->get('/conflict/budi')
        ->assertSeeText("Conflict budi");

        $this->get('/conflict/eko')
        ->assertSeeText("Conflict eko");
    }

    //test names route
    public function testNameRoute()
    {
        $this->get('/produk/12345')
        ->assertSeeText('Link http://localhost/products/12345 ');

        $this->get('/produk-redirect/12345')
        ->assertRedirect('/products/12345');
    }

}
