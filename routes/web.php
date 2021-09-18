<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/tool', 'App\Http\Controllers\ToolController@index')
    ->name('KeyWordDensityTool');
Route::post('/tool/calculate-and-get-density', 'App\Http\Controllers\ToolController@CalculateAndGetDensity');


