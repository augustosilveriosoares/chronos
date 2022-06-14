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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('welcome');
Route::post('zap','AtendimentoController@zap')->name('zap');
Route::post('webscheduling','AtendimentoController@webscheduling')->name('webscheduling');

Auth::routes();

Route::get('dashboard', 'HomeController@index')->name('home');

Route::get('pricing', 'PageController@pricing')->name('page.pricing');
Route::get('lock', 'PageController@lock')->name('page.lock');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('category', 'CategoryController', ['except' => ['show']]);
    Route::resource('atendimentos', 'AtendimentoController');
    Route::resource('situacao', 'SituacaoController');

    Route::resource('parametro', 'ParametroAtendimentoController');

    Route::get('showByCalendar', ['as' => 'showByCalendar', 'uses' => 'AtendimentoController@showByCalendar']);
    Route::get('showByCalendar', ['as' => 'showByCalendarEvent', 'uses' => 'AtendimentoController@showByCalendarEvent']);
    Route::put('updateByAdvogado', ['as' => 'updateByAdvogado', 'uses' => 'AtendimentoController@updateByAdvogado']);

    Route::resource('agendamento', 'EventController');

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@index']);
    Route::resource('observacao', 'ObservacaoAtendimentoController');
    Route::resource('tag', 'TagController', ['except' => ['show']]);
    Route::resource('item', 'ItemController', ['except' => ['show']]);
    Route::resource('role', 'RoleController', ['except' => ['show', 'destroy']]);
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::resource('fullcalendar', 'FullCalendarController');
    Route::get('full', ['as' => 'full', 'uses' => 'FullCalendarController@index']);
    Route::get('events', ['as' => 'fullcalendar.events', 'uses' => 'FullCalendarController@events']);
    Route::get('teste', ['as' => 'fullcalendar.teste', 'uses' => 'FullCalendarController@teste']);
    Route::put('event/add', ['as' => 'event.add', 'uses' => 'EventController@store']);
    Route::post('event/update', ['as' => 'event.update', 'uses' => 'EventController@update']);
    Route::delete('event/destroy/{id}', [\App\Http\Controllers\EventController::class,'destroy'])->name('event.destroy');


    Route::get('transferencia', ['as' => 'transferencia.index', 'uses' => 'UtilController@transferencia']);
    Route::post('transferencia', ['as' => 'transferencia.transfere', 'uses' => 'UtilController@transfereAtendimentos']);

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
//    Google Routes
    Route::name('google.index')->get('google', 'GoogleAccountController@index');
    Route::name('google.store')->get('google/oauth', 'GoogleAccountController@store');
    Route::name('google.destroy')->delete('google/{googleAccount}', 'GoogleAccountController@destroy');

});




