<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterAuthController;
use App\Http\Controllers\Auth\LoginAuthController;

use App\Http\Controllers\Category\GetAllCategoriesController;


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

    Route::get('categories',GetAllCategoriesController::class);

}); 