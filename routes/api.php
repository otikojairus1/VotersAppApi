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

Route::post('/register', [\App\Http\Controllers\UserController::class, "register"]);

Route::post('/login', [\App\Http\Controllers\UserController::class, "login"]);
Route::post('/add/question', [\App\Http\Controllers\UserController::class, "add"]);
Route::get('/all/questions', [\App\Http\Controllers\QuestionController::class, "all"]);
Route::post('/vote', [\App\Http\Controllers\VoteController::class, "vote"]);
Route::get('/all/votes', [\App\Http\Controllers\VoteController::class, "allVotes"]);
