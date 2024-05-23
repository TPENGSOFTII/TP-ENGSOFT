<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCarController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'users'], function () {
    Route::post('/', [UserController::class, 'createUser']);
    Route::put('/{id}', [UserController::class, 'updateUser']);
    Route::delete('/{id}', [UserController::class,'deleteUser']);
    Route::post('/{userId}/cars/{carId}/associate', [UserCarController::class, 'associateUserToCar']);
    Route::delete('/{userId}/cars/{carId}/disassociate', [UserCarController::class, 'disassociateUserFromCar']);
    Route::get('/{userId}/cars', [UserCarController::class, 'getUserCars']);
});

Route::group(['prefix' => 'cars'], function () {
    Route::post('/', [CarController::class,'createCar']);
    Route::get('/', [CarController::class, 'getAllCars']);
    Route::put('/{id}', [CarController::class, 'updateCar']);
    Route::delete('/{id}', [CarController::class,'deleteCar']);
});
