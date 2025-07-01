<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\HotelRoomController;
use App\Http\Controllers\Api\RoomTypeController;
use App\Http\Controllers\Api\AccommodationController;
use App\Http\Controllers\Api\CityController;


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

Route::prefix('hotels')->group(function () {
    
    // CRUD de hoteles
    Route::get('/', [HotelController::class, 'index']);     // Listar todos los hoteles
    Route::post('/', [HotelController::class, 'store']);    // Crear un nuevo hotel
    Route::get('{hotel}', [HotelController::class, 'show']); // Ver un hotel
    Route::put('{hotel}', [HotelController::class, 'update']); // Actualizar hotel
    Route::delete('{hotel}', [HotelController::class, 'destroy']); // Eliminar hotel

    // Gestión de habitaciones por hotel
    Route::prefix('{hotel}/rooms')->group(function () {
        Route::get('/', [HotelRoomController::class, 'index']);    // Listar habitaciones del hotel
        Route::post('/', [HotelRoomController::class, 'store']);   // Asignar habitaciones al hotel
        Route::put('{room}', [HotelRoomController::class, 'update']); // Actualizar asignación
        Route::delete('{room}', [HotelRoomController::class, 'destroy']); // Eliminar asignación
    });
    
});

Route::get('/room-types', [RoomTypeController::class, 'index']);
Route::apiResource('/accommodations', AccommodationController::class);
Route::get('/cities', [CityController::class, 'index']);
Route::get('/hotels/{hotel}/accommodations', [HotelRoomController::class, 'index']);
