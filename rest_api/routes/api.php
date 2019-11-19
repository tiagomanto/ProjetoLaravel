<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Http\Resources\User as UserResource;
use App\User;
//use Symfony\Component\Routing\Route;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ok', function(){
    return ['status' => true];
});

Route::middleware('cache.headers:public;max_age=2628000;etag')->group(function() {
    Route::get('privacy', function () {
        // ...
    });
    Route::get('/ok2', function(){
    return response('Ok 2', 200)
                  ->header('Content-Type', 'text/plain')
                  ->cookie('Ok2','123123123123','10');
    });
});

Route::get('/user', function () {
    return UserResource::collection(User::all());
});


Route::get('/login','LoginController@index')->name('login'); 


Route::get('/users', function () { 
    return new UserCollection(User::all()->keyBy->id);
});

Route::get('/users', function () {
    return new UserCollection(User::paginate());
});

Route::namespace('API')->name('api.')->group(function(){
    Route::prefix('/products') -> group(function(){

        Route::get('/','ProductController@index')->name('index_products'); 
        Route::get('/{id}', 'ProductController@show')->name('single_products');

        Route::post('/', 'ProductController@store')->name('store_products');
       // Route::post('/', 'ProductController@store2')->name('store_products2');
        Route::put('/{id}', 'ProductController@update')->name('update_products');            

        Route::delete('/{id}', 'ProductController@delete')->name('delete_products'); 
        
        Route::options('/rec','ProductController@verbosrecurso')->name('verbo_recursos');
        });
    });