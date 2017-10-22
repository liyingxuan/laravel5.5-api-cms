<?php
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



/**
 * Api Doc
 */
Route::get('/doc', '\App\Api\Controllers\ApiDoc@index');



$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => ['jwt.api.auth']], function ($api) {
        /**
         * Register & Login
         */
        $api->post('verify-code', 'AuthController@sendVerifyCode');
        $api->post('login', 'AuthController@authenticate');

        /**
         * Token Auth
         */
        $api->group(['middleware' => 'jwt.auth'], function ($api) {
            // Init
            $api->group(['prefix' => 'init'], function ($api) {
//                $api->get('/', 'InitController@index');
            });
        });
    });
});
