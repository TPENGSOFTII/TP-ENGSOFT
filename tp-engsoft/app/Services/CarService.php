<?php

namespace App\Services;

use App\Repositories\Car\CarRepositoryInterface;

class CarService extends BaseService
{
    public function __construct(CarRepositoryInterface $carRepository)
    {
        parent::__construct($carRepository);
    }
}
