<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\CreateCarRequest;
use App\Services\CarService;

class CarController extends Controller
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function createCar(CreateCarRequest $request)
    {
        try {
            $carData = $request->validated();

            $car = $this->carService->createCar($carData);

            return response()->json(['car' => $car], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor.'], 500);
        }
    }

    public function getAllCars()
    {
        try {
            $cars = $this->carService->getAllCars();

            return response()->json(['cars' => $cars], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor.'], 500);
        }
    }
}
