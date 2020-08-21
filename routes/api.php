<?php

use Illuminate\Http\Request;

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

if (App::environment('production', 'staging')) {
   URL::forceScheme('https');
}


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('banks', 'BankController@get');
Route::get('states', 'StateController@get');
Route::get('districts', 'DistrictController@get');
Route::get('cities', 'CityController@get');
Route::get('branches', 'BranchController@get');
Route::get('metas', 'MetaController@get');