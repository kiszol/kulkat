<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KapcsolatController;
use App\Http\Controllers\Api\KategoriaController;
use App\Http\Controllers\Api\KepessegController;
use App\Http\Controllers\Api\LenyController;
use App\Http\Controllers\Api\GaleriaController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/contact', [KapcsolatController::class, 'store']);

// Public read routes
Route::get('/creatures', [LenyController::class, 'index']);
Route::get('/creatures/{id}', [LenyController::class, 'show']);
Route::get('/kategoriak', [KategoriaController::class, 'index']);
Route::get('/kategoriak/{id}', [KategoriaController::class, 'show']);
Route::get('/kepessegek', [KepessegController::class, 'index']);
Route::get('/kepessegek/{id}', [KepessegController::class, 'show']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Creatures (Lények) - csak bejelentkezett user
    Route::post('/creatures', [LenyController::class, 'store']);
    Route::put('/creatures/{id}', [LenyController::class, 'update']);
    Route::delete('/creatures/{id}', [LenyController::class, 'destroy']);

    // Creature abilities
    Route::post('/creatures/{id}/abilities', [LenyController::class, 'attachKepesseg']);
    Route::delete('/creatures/{lenyId}/abilities/{kepessegId}', [LenyController::class, 'detachKepesseg']);

    // Gallery
    Route::get('/creatures/{lenyId}/gallery', [GaleriaController::class, 'index']);
    Route::post('/creatures/{lenyId}/gallery', [GaleriaController::class, 'store']);
    Route::delete('/creatures/{lenyId}/gallery/{kepId}', [GaleriaController::class, 'destroy']);

    // Categories (csak admin)
    Route::post('/kategoriak', [KategoriaController::class, 'store']);
    Route::put('/kategoriak/{id}', [KategoriaController::class, 'update']);
    Route::delete('/kategoriak/{id}', [KategoriaController::class, 'destroy']);

    // Abilities (csak admin)
    Route::post('/kepessegek', [KepessegController::class, 'store']);
    Route::put('/kepessegek/{id}', [KepessegController::class, 'update']);
    Route::delete('/kepessegek/{id}', [KepessegController::class, 'destroy']);

    // Contact messages (csak admin)
    Route::get('/contact', [KapcsolatController::class, 'index']);
    Route::patch('/contact/{id}/read', [KapcsolatController::class, 'markAsRead']);
});
