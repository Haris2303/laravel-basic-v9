<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
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
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($product, $item) {
    return "Product: $product, Item: $item";
})->name('product.item.detail');

// Regex paramter
Route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

// Optional parameter
Route::get('/users/{id?}', function ($userId = 404) {
    return "User $userId";
})->name('user.detail');

// conflict
Route::get('/conflict/hello', function () {
    return "Conflict Hello World";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});


Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::get('/controller/hello/request', [App\Http\Controllers\HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [App\Http\Controllers\HelloController::class, 'hello']);

Route::get('/input/hello', [App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello/first', [App\Http\Controllers\InputController::class, 'helloFirstName']);
Route::post('/input/hello/input', [App\Http\Controllers\InputController::class, 'helloInput']);
Route::post('/input/hello/array', [App\Http\Controllers\InputController::class, 'helloArray']);

Route::post('/input/type', [App\Http\Controllers\InputController::class, 'inputType']);

Route::post('/input/filter/only', [App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [App\Http\Controllers\InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [App\Http\Controllers\InputController::class, 'filterMerge']);

Route::post('/file/upload', [App\Http\Controllers\FileController::class, 'upload'])
    ->withoutMiddleware([App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

// Grouping route prefix
Route::prefix('/response/type')->group(function () {
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

Route::get('/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [CookieController::class, 'clearCookie']);

// Grouping route controller
Route::controller(RedirectController::class)->group(function () {
    Route::get('/redirect/from', 'redirectFrom');
    Route::get('/redirect/to', 'redirectTo');
    Route::get('/redirect/name', 'redirectName');
    Route::get('/redirect/name/{name}', 'redirectHello')->name('redirect-hello');
    Route::get('/redirect/action', 'redirectAction');
    Route::get('/redirect/away', 'redirectAway');
    Route::get('/redirect/named', function () {
        // return route('redirect-hello', ['name' => 'Udin']);
        // return url()->route('redirect-hello', ['name' => 'Udin']);
        return Illuminate\Support\Facades\URL::route('redirect-hello', ['name' => 'Udin']);
    });
});

// Grouping routes multiple middleware and prefix
Route::middleware('contoh:UDIN-TAMVAN,401')->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return 'OK';
    });

    Route::get('/group', function () {
        return 'GROUP';
    });
});

Route::get('/form', [App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [App\Http\Controllers\FormController::class, 'submit']);

Route::get('/url/current', function () {
    return Illuminate\Support\Facades\URL::full();
});
Route::get('/url/action', function () {
    // return action([App\Http\Controllers\FormController::class, 'form'], []);
    // return url()->action([App\Http\Controllers\FormController::class, 'form'], []);
    return Illuminate\Support\Facades\URL::action([App\Http\Controllers\FormController::class, 'form'], []);
});

Route::get('/session/create', [App\Http\Controllers\SessionController::class, 'createSession']);
Route::get('/session/get', [App\Http\Controllers\SessionController::class, 'getSession']);

Route::get('/error/sample', function () {
    throw new Exception('Sample Error');
});
Route::get('/error/manual', function () {
    report(new Exception('Sample Error'));
    return "OK";
});
Route::get('/error/validation', function () {
    throw new App\Exceptions\ValidationException('Validation Error');
});

Route::get('/abort/400', function () {
    abort(400, "Ops validation error");
});
Route::get('/abort/401', function () {
    abort(401);
});
Route::get('/abort/500', function () {
    abort(500);
});
