<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersActionsController;
use App\Http\Controllers\CategoryActionsController;

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
    return redirect('/users');
});
Route::get('/users', [UsersController::class, 'index']);
Route::post('/users', [UsersController::class, 'store']);
Route::post('/users/{user}', [UsersController::class, 'update']);
Route::post('/users/create', [UsersController::class, 'create']);
Route::get('/users/{user}', [UsersController::class, 'edit']);
Route::delete('/users/{user}', [UsersController::class, 'destroy']);
Route::get('/get-users', [UsersActionsController::class, 'getAllUsers']);
Route::get('/search-users', [UsersActionsController::class, 'searchUsers']);
Route::get('/get-countries', [CategoryActionsController::class, 'getCountries']);
