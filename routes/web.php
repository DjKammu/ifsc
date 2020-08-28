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

if (App::environment('production', 'staging')) {
   URL::forceScheme('https');
}

Route::get('/migration', function () {
    Artisan::call('migrate');
    $exitCode = Artisan::call('migrate', [] );
    echo $exitCode;
});

Route::get('/storage', function () {
    Artisan::call('storage:link');
    $exitCode = Artisan::call('storage:link', [] );
    echo $exitCode;
});

 Route::get('/clear-cache', function() {
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    $run = Artisan::call('serve');
    return 'CLEARED';  
});

/*SITE MAP */
Route::get('/sitemap/index.xml', 'SitemapController@index');
Route::get('/sitemap/pages.xml', 'SitemapController@pages');
Route::get('/sitemap/banks.xml', 'SitemapController@banks');


Route::get('/{any}', function(){
	return view('welcome');
})->where('any', '.*');