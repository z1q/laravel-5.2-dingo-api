<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('api', function () {
    return view('welcome');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web']], function () {
    //
});

/*
 *
 * api
 *
 *
 * */
// 接管路由
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
        $api->post('login', 'UserController@login')->name('api.login');
        $api->post('phonelogin', 'UserController@phonelogin')->name('api.phonglogin');
        $api->post('reg', 'UserController@reg')->name('api.reg');
        $api->post('phonereg', 'UserController@phonereg')->name('api.phonereg');
        $api->post('verif', 'UserController@lverif')->name('api.verif');
        $api->post('forget', 'UserController@forget')->name('api.forget');
        //$api->get('/', function () {return "welcome";})->name('api.index');
    });
});
/*
 * reg$api->post('/users/{user_name}/register','UserController@register');
 * */
