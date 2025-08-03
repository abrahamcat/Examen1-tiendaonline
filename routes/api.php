<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MarcaController;
use App\Http\Controllers\Api\ProductoController;

// Rutas públicas de autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Rutas para Marcas
    Route::apiResource('/marcas', MarcaController::class);
    
    // Rutas para Productos
    Route::apiResource('/productos', ProductoController::class);
    
    // Ruta para obtener información del usuario autenticado
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });
});

// Ruta de fallback para rutas no encontradas
Route::fallback(function(){
    return response()->json([
        'success' => false,
        'message' => 'Ruta no encontrada'
    ], 404);
});