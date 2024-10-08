<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoUserController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return response()->json([
        'message' => 'Welcome to my API',
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', function (Request $request) {
            return $request->user();
        });

        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::put('/user', [UserController::class, 'update']);
        Route::put('/change-password', [UserController::class, 'updatePassword']);
        Route::delete('/user', [UserController::class, 'destroy']);

        Route::get('/todos', [TodoController::class, 'index']);
        Route::get('/todos/{todo}', [TodoController::class, 'show']);
        Route::post('/todos', [TodoController::class, 'store']);
        Route::put('/todos/{todo}', [TodoController::class, 'update']);
        Route::put('/todos/{todo}/complete', [TodoController::class, 'completed']); //to be done
        Route::delete('/todos/{todo}', [TodoController::class, 'destroy']);

        Route::get('/user/todos', [TodoUserController::class, 'index']);
        Route::get('/user/todos/{todo}', [TodoUserController::class, 'show']);
    });
});

