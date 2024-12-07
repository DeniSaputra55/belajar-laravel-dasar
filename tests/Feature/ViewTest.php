<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    //test rendering view
   public function testView()
   {
    $this->get('/hello')
    ->assertSeeText('Hello eko');

    $this->get('/hello-again')
    ->assertSeeText('Hello Eko');
   }

   public function testNested()
   {
    $this->get('/hello-world')
    ->assertSeeText('Wolrd Eko');
   }
   //test view tanpa route
   public function testTemplate()
   {
    $this->view('hello', ['name'=> 'Eko'])
    ->assertSeeText('Hello Eko');

    $this->view('hello.world', ['name' => 'Eko'])
    ->assertSeeText('World Eko');
   }
}
