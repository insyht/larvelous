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

Auth::routes();

/**
 * Dashboard routes
 */
Route::namespace('Website')->group(function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('/voorbeeld/categorie', 'VoorbeeldController@categorie');
    Route::get('/voorbeeld/subcategorie', 'VoorbeeldController@subcategorie');
    Route::get('/voorbeeld/product', 'VoorbeeldController@product');
    Route::get('/voorbeeld/winkelwagen', 'VoorbeeldController@winkelwagen');
    Route::get('/voorbeeld/klantgegevens', 'VoorbeeldController@klantgegevens');
    Route::get('/voorbeeld/betaling', 'VoorbeeldController@betaling');
    Route::get('/voorbeeld/bevestiging', 'VoorbeeldController@bevestiging');
    Route::get('/voorbeeld/textpagina', 'VoorbeeldController@textpagina');
    Route::get('/voorbeeld/landingspagina', 'VoorbeeldController@landingspagina');
    Route::get('/voorbeeld/contact', 'VoorbeeldController@contact');
});

/**
 * Dashboard routes
 */
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function() {
    Route::get('/', 'DashboardController@index')->name('index');

    Route::get('/blocks', 'BlockController@index')->name('blocks.index');
    Route::get('/forms', 'FormController@index')->name('forms.index');
    Route::get('/templates', 'TemplateController@index')->name('templates.index');
    Route::get('/pages', 'PageController@index')->name('pages.index');
    Route::get('/menus', 'MenuController@index')->name('menus.index');

    Route::get('/media', 'MediaController@index')->name('media.index');
    Route::get('/design', 'DesignController@index')->name('design.index');

    Route::get('/plugins', 'PluginController@index')->name('plugins.index');
    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::get('/statistics', 'StatisticsController@index')->name('statistics.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
