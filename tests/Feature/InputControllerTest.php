<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Eko')
            ->assertSeeText('Hello Eko');

        $this->post('/input/hello', [
            'name' => 'Eko'
        ])->assertSeeText('Hello Eko');
    }

    //test nested input
    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name" => [
                "first" => "Eko",
                "last" => "Edy"
            ]
        ])->assertSeeText("Hello Eko");
    }

    //mengambil semua input
    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name" => [
                "first" => "Eko",
                "last" => "edy"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Eko")
            ->assertSeeText("edy");
    }

    //test mengambil input array
    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products" => [
                [
                    "name" => "Apple ",
                    "price" => 200000
                ],
                [
                    "name" => "Samsung",
                    "price" => 120000
                ]
            ]
        ])->assertSeeText("Apple")
            ->assertSeeText("Samsung");
    }

    //input type
    public function testInputType()
    {
        $this->post('/input/type', [
            'name' => 'Budi',
            'married' => 'true',
            'birt_date' => '1990-10-10'
        ])->assertSeeText('budi')->assertSeeText("true")->assertSeeText("1990-10-10");
    }

    public function testFilterOnly()
    {
        $this->post('/input/filter/only', [
            "name" => [
                "first" => "Eko",
                "middle" => "Kurniawan",
                "last" => "Khanedy"
            ]
        ])->assertSeeText("Eko")->assertSeeText("Khanedy")
            ->assertSeeText("Kurniawan");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username" => "khanedy",
            "password" => "rahasia",
            "admin" => "true"
        ])->assertSeeText("Khanedy")->assertSeeText("rahasia")
        ->assertSeeText("admin")->assertSeeText("false");
    }
}
