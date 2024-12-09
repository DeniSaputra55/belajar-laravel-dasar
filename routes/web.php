<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function(){
    return "Hello programmer zaman now";
});

Route::redirect('/youtube', '/pzn');
//fallback route
Route::fallback(function (){
    return "404 by Programmer Zaman Now";
});
//rendering view
Route::view('/hello', 'hello', ['name' => 'eko']);
Route::get('/hello-again', function(){
    return view('hello', ['name'=>'eko']);
});
//nested view directory
Route::get('/hello-world', function (){
    return view('hello.world', ['name' => "eko"]);
});