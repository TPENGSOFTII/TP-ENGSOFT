<?php

namespace App\Services;

use App\Repositories\Car\CarRepositoryInterface;

class CarService
{
    protected $carRepository;

    public function __construct(CarRepositoryInterface $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function createCar(array $data)
    {
        return $this->carRepository->create($data);
    }
}