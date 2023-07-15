<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterAuthController;
use App\Http\Controllers\Auth\LoginAuthController;

use App\Http\Controllers\Category\GetAllCategoriesController;

use App\Http\Controllers\ToDo\CreateToDoController;
use App\Http\Controllers\ToDo\GetAllToDoByUserController;
use App\Http\Controllers\ToDo\GetToDoController;
use App\Http\Controllers\ToDo\UpdateToDoController;
use App\Http\Controllers\ToDo\DeleteToDoController;


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

//PUBLIC ROUTES
Route::post('register',RegisterAuthController::class);
Route::post('login',LoginAuthController::class);

//Private
Route::middleware(['auth:sanctum'])->group(function()
{
    Route::post('todo',CreateToDoController::class);
    Route::get('todos',GetAllToDoByUserController::class);
    Route::get('todo/{todo}',GetToDoController::class);
    Route::put('todo/{todo}',UpdateToDoController::class);
    Route::delete('todo/{todo}',DeleteToDoController::class);

    Route::get('categories',GetAllCategoriesController::class);

}); 