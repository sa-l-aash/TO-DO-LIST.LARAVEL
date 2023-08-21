<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//task controller routes but with relation to the user model
Route::get('/getUsers',[TaskController::class,'getUsers']);
Route::get('/getUser',[TaskController::class,'getUser']);
//user controller routes 
Route::post('/createUser',[UserController::class,'createUser']);
Route::get('/readAllUsers',[UserController::class,'readAllUsers']);
Route::get('/readOneUser',[UserController::class,'readOneUser']);
//task controller routes
Route::post('/createTask',[TaskController::class,'createTask']);
Route::get('/readOneTask',[TaskController::class,'readOneTask']);
Route::get('/readAllTasks',[TaskController::class,'readAllTasks']);


