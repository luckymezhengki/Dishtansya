<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function(){
    return response()->json('Distansya API');
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

// this where I have to check the logged account
// i need to setup header content-type and authorization via postman
Route::middleware('auth')->get('/login', function () {
    return auth()->user();
});


Route::middleware('auth')->group(function() { 
    Route::get('/products', 'ProductController@index');
    Route::post('/order', 'OrderController@store');
});

/* 
// default by laravel
Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});
 */

