<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::GET('/',[TodoController::class,'index']);
    Route::POST('/todos', [TodoController::class,'store']);
    Route::PATCH('/todos/update', [TodoController::class,'update']);
    Route::DELETE('/todos/delete', [TodoController::class,'destroy']);
    Route::GET('todos/search', [TodoController::class,'search']);

    Route::GET('/categories', [CategoryController::class,'index']);
    Route::POST('/categories', [CategoryController::class,'store']);
    Route::PATCH('/categories/update', [CategoryController::class,'update']);
    Route::DELETE('/categories/delete', [CategoryController::class,'destroy']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
