<?php

namespace App\Repositories\Car;

use App\Models\Car;

class CarRepository implements CarRepositoryInterface
{
    public function create(array $data)
    {
        return Car::create($data);
    }

}