<?php

use App\Http\Controllers\Api\ProblemSolvingController;
use App\Http\Controllers\Api\UserController;
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

Route::controller(ProblemSolvingController::class)->group(function(){

    Route::get('/count/{first_number}/{second_number}','count_numbers');
    Route::get('/alphabet/{input_string}','alphabet_index');
    Route::get('/minimize/{N}/{array}','minimize');
});


Route::controller(UserController::class)->group(function(){
    Route::get('/users','index');
    Route::post('/register','register');
    Route::post('/login','login');
    Route::get('/user/{id}','get_user');
    Route::post('/update/{id}','update');
    Route::Post('/delete/{id}','destroy');

});

