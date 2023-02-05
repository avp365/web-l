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

Route::name('api.')->prefix('v1')->middleware('auth:api')
    ->group(function () {
        Route::apiResource('constructions', 'Api\LangConstructor\LangConstructorController')->parameters([
            'constructions' => 'constructions'
        ]);;
    });
