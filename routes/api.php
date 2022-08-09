<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group( ['middleware' => ["auth:sanctum"]], function(){
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);

    //Rutas para las tareas
    Route::get('/tasks', [TaskController::class,'index']); //muestra todos los registros
    Route::get('/tasks/{id}', [TaskController::class,'show']); //muestra un registro
    Route::post('/tasks', [TaskController::class,'store']); // crea un registro
    Route::put('/tasks/{id}', [TaskController::class,'update']); // actualiza un registro
    Route::delete('/tasks/{id}', [TaskController::class,'destroy']); //elimina un registro
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
