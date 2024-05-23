<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserCarController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
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
