<?php

namespace App\Http\Controllers;

use App\Http\Requests\Car\CreateCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Services\CarService;

class CarController extends BaseApiController
{
    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function createCar(CreateCarRequest $request)
    {
        $carData = $request->validated();
        return $this->handleCreate($carData, [$this->carService, 'create']);
    }

    public function updateCar($id, UpdateCarRequest $request)
    {
        $carData = $request->validated();
        return $this->handleUpdate($id, $carData, [$this->carService, 'update']);
    }

    public function deleteCar($id)
    {
        return $this->handleDelete($id, [$this->carService, 'delete'], "Carro");
    }

    public function getAllCars()
    {
        return $this->handleGetAll([$this->carService, 'getAll']);
    }
}
