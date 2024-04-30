<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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




Route::group(["middleware" => ["apiToken"]], function () {

    Route::post("getEmployees", [
        'as' => 'api.getEmployees',
        "uses" => "App\Http\Controllers\ApiController@getEmployees",
    ]);
});
