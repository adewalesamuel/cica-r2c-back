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

Route::get('/front{any}', function () {
    return view('front');
})->where('any', '.*');

Route::get('/{any1}', function () {
    return view('back');
})->where('any1', '.*');