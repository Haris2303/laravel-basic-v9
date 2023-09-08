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

Route::get('/pzn', function () {
    return "Hello Programmer Zaman Now";
});

Route::redirect('/youtube', '/pzn');

// make a view 404
Route::fallback(function () {
    return "404 Page Not Found";
});

Route::view('/hello', 'hello', ['name' => 'Haris']);
Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Ilham']);
});
Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'Minecraft']);
});

Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
});

Route::get('/products/{product}/items/{item}', function ($product, $item) {
    return "Product: $product, Item: $item";
});

// Regex paramter
Route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+');

// Optional parameter
Route::get('/users/{id?}', function ($userId = 404) {
    return "User $userId";
});

// conflict
Route::get('/conflict/hello', function () {
    return "Conflict Hello World";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});
