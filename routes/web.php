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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Dashboard routes
 */
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard')->group(function() {
    Route::get('/', 'DashboardController@index')->name('index');

    Route::get('/blocks', 'BlockController@index')->name('index');
    Route::get('/forms', 'FormController@index')->name('index');
    Route::get('/templates', 'TemplateController@index')->name('index');
    Route::get('/pages', 'PageController@index')->name('index');
    Route::get('/menus', 'MenuController@index')->name('index');

    Route::get('/plugins', 'PluginController@index')->name('index');
    Route::get('/settings', 'SettingsController@index')->name('index');
    Route::get('/statistics', 'StatisticsController@index')->name('index');

    Route::get('/media', 'MediaController@index')->name('index');
    Route::get('/design', 'DesignController@index')->name('index');
});
