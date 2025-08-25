<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\BoardingPassController;

Route::prefix('flights')->group(function () {
    // Ver un vuelo
    Route::get('{id}', [FlightController::class, 'show']);
    
    // Ver pasajeros de un vuelo
    Route::get('{id}/passengers', [FlightController::class, 'showPassengers']);
    
    // Opcional: CRUD de vuelos
    Route::post('/', [FlightController::class, 'store']);
    Route::put('{id}', [FlightController::class, 'update']);
    Route::delete('{id}', [FlightController::class, 'destroy']);
    
    // Boarding passes de un vuelo
    Route::get('{flightId}/boarding-passes', [BoardingPassController::class, 'getBoardingPasses']);
});

// Ruta de prueba
Route::get('test-api', function() {
    return 'API funcionando!';
});


