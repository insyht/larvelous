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

use App\Http\Controllers\Dashboard\BlockController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DesignController;
use App\Http\Controllers\Dashboard\FormController;
use App\Http\Controllers\Dashboard\MediaController;
use App\Http\Controllers\Dashboard\MenuController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\PluginController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\StatisticsController;
use App\Http\Controllers\Dashboard\TemplateController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Auth::routes();

/**
 * Dashboard routes
 */
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/blocks', [BlockController::class, 'index'])->name('blocks.index');
    Route::get('/forms', [FormController::class, 'index'])->name('forms.index');
    Route::get('/templates', [TemplateController::class, 'index'])->name('templates.index');
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');

    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::get('/design', [DesignController::class, 'index'])->name('design.index');

    Route::get('/plugins', [PluginController::class, 'index'])->name('plugins.index');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
});

Auth::routes();

Route::get('/admin/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/admin');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Website')->group(function () {
    Route::get('/voorbeeld/categorie', 'VoorbeeldController@categorie')->name('voorbeeld-categorie');
    Route::get('/voorbeeld/product', 'VoorbeeldController@product')->name('voorbeeld-product');
    Route::get('/voorbeeld/winkelwagen', 'VoorbeeldController@winkelwagen')->name('voorbeeld-winkelwagen');
    Route::get('/voorbeeld/klantgegevens', 'VoorbeeldController@klantgegevens')->name('voorbeeld-klantgegevens');
    Route::get('/voorbeeld/bevestiging', 'VoorbeeldController@bevestiging')->name('voorbeeld-bevestiging');
    Route::get('/voorbeeld/textpagina', 'VoorbeeldController@textpagina')->name('voorbeeld-textpagina');
    Route::get('/voorbeeld/landingspagina', 'VoorbeeldController@landingspagina')->name('voorbeeld-landingspagina');
    Route::get('/voorbeeld/contact', 'VoorbeeldController@contact')->name('voorbeeld-contact');
    Route::get('/{pageName}', 'PageController@load')->where('pageName', '.*');
});
