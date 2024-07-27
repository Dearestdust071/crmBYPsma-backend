<?php

// use App\Models\Usuario;
// use Illuminate\Http\Request;
use App\Models\Personal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\GuardiasController;
use App\Http\Controllers\TurnosController;
use App\Http\Controllers\ActividadesController;
use App\Http\Controllers\AsistenciasController;
use App\Http\Controllers\SancionesController;
use App\Models\User;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });






Route::post('/register', [UsuarioController::class, 'register']);
Route::post('/login', [UsuarioController::class, 'login']);


Route::middleware("autorizado")->group(function () {
    
    //Controladores del usuario 
    Route::get('/usuarios', [UsuarioController::class,'index']);
    Route::get('/usuarios/{id}', [UsuarioController::class,'show']);
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);
    Route::put('/usuarios/{id}', [UsuarioController::class,'update']);
    Route::post('/usuarios', [UsuarioController::class, 'store']);

    Route::apiResource('personal', PersonalController::class);
    Route::apiResource('roles', RolesController::class);
    Route::apiResource('guardias', GuardiasController::class);
    Route::apiResource('turnos', TurnosController::class);
    Route::apiResource('actividades', ActividadesController::class);
    Route::apiResource('asistencias', AsistenciasController::class);
    Route::apiResource('sanciones', SancionesController::class);
    

});