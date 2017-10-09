<?php

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
    return redirect('entrar');
});

Route::get('/entrar', function() {
    return view('authentication.login');
})->name("entrar");

Route::post('login', ['as' => 'login', 'uses' => 'CustomAuthController@login']);

Route::get('/registro', function() {
    return view('authentication.register');
})->name('registro');

Route::post('register', ['as' => 'register', 'uses' => 'CustomAuthController@register']);

Route::get('logout', ['as' => 'logout', 'uses' => 'AppController@logout']);

//Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', ['as' => 'inicio', 'uses' => 'AppController@index']);
    Route::get('chat/{username}',['as' => 'chat', 'uses' => 'AppController@usersChat']);
});