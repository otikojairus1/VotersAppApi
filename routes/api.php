<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
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

Route::post('/register', [UserController::class, "register"]);

Route::post('/login', [UserController::class, "login"]);
Route::post('/add/question', [UserController::class, "add"]);
Route::get('/all/questions', [QuestionController::class, "all"]);
Route::post('/voting', [UserController::class, "Voting"]);
Route::get('/all/votes', [VoteController::class, "allVotes"]);
