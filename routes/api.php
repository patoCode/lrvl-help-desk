<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TecnicoController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AuthController;


Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
// OUT
    Route::post('/logout', [AuthController::class, 'logout']);
// CATEGORY
    Route::get('/category',[CategoryController::class, 'index']);
    Route::post('/category',[CategoryController::class, 'store']);
    Route::get('/category/{id}',[CategoryController::class, 'show']);
    Route::put('/category/{id}', [CategoryController::class, 'edit']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

//COLA
    Route::get('/cola',[ColaController::class, 'index']);
    Route::get('/cola/{id}',[ColaController::class, 'show']);
    Route::put('/cola/{id}', [ColaController::class, 'edit']);
    Route::delete('/cola/{id}', [ColaController::class, 'destroy']);
    Route::post('/cola/add-technician',[ColaController::class, 'addTechnician']);
    Route::post('/cola/status-technician',[ColaController::class, 'setStatusTechnician']);

// USERS
    Route::get('/user',[UserController::class, 'index']);
    Route::get('/user/{id}',[UserController::class, 'show']);
    Route::put('/user/{id}',[UserController::class, 'edit']);
    Route::post('/user',[UserController::class, 'store']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
    Route::post('/user/add-rol', [UserController::class, 'addRol']);

// TECHNICAL USERS
    Route::get('/technical',[TecnicoController::class, 'index']);
    Route::get('/technical/{id}',[TecnicoController::class, 'show']);
    Route::get('/technical/available/{category}',[TecnicoController::class, 'notInCategory']);


// SOLICITUDES
    Route::get('/incident',[SolicitudController::class, 'index']);
    Route::post('/incident',[SolicitudController::class, 'store']);
    Route::post('/incident/event',[SolicitudController::class, 'event']);
    Route::post('/incident/solve',[SolicitudController::class, 'solve']);
});




