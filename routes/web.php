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
//route paramter
Route::get('/products/{id}', function ($productId){
    return "Product $productId";
})->name('product.detail');

Route::get('products/{product}/items/{item}', function ($productId, $itemId){
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

//route regular expression contraint
Route::get('categories/{id}', function ($categoryId){
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('catgeory.detail');

//optional route parameter
Route::get('/users/{id?}', function($userId = '404'){
    return "User $userId";
})->name('user.detail');

//routing conflict
Route::get('/conflict/eko', function (){
    return "Conflict Eko Kurniawan ";
});

Route::get('/conflict/{name}', function ($name){
    return "Conflict $name";
});

//menggunakan names route
Route::get('/produk/{id}', function ($id){
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id){
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::get('/controller/hello/request', [\App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirstName']);
//mengambil semua input
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);
//array input
Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'helloArray']);
//input type
Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);
Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);