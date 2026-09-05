<?php

use App\Http\Controllers\Api\Perfil\PerfilController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RolesController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout']);
        Route::post('/refresh', [LoginController::class, 'refresh']);
        Route::post('/me', [LoginController::class, 'me']);
        Route::prefix('roles')->group(function () {
            Route::get('/', [RolesController::class, 'index']);
            Route::post('/', [RolesController::class, 'store']);
            Route::put('/{id}', [RolesController::class, 'update']);
            Route::delete('/{id}', [RolesController::class, 'destroy']);
        });
        Route::prefix('permissions')->group(function () {
            Route::get('/', [RolesController::class, 'getPermissions']);
        });
    });
});
Route::middleware('auth:api')->prefix('perfiles')->group(function(){
    Route::get('/',[PerfilController::class,'index'])
    ->middleware('role_or_permission:admin|viewer|edit_user');
    Route::post('/',[PerfilController::class,'crearPerfil']);
});
