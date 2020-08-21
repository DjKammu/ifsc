<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('banks', BankController::class);
    $router->resource('states', StateController::class);
    $router->resource('districts', DistrictController::class);
    $router->resource('cities', CityController::class);
    $router->get('/state/districts','StateController@districts');
    $router->get('/district/cities','DistrictController@cities');
    $router->resource('branches', BranchController::class);
    
    $router->get('import/branches', 'BranchController@getImport')->name('branches.import');
    $router->post('import/branches', 'BranchController@postImport')->name('post.branches.import');   
});
