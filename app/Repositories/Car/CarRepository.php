<?php

namespace App\Repositories\Car;

use App\Models\Car;

class CarRepository implements CarRepositoryInterface
{
    public function create(array $data)
    {
        return Car::create($data);
    }
    public function getAll()
    {
        return Car::all();
    }
    
    public function findById($id)
    {
        return Car::findOrFail($id);
    }

    public function update($id, $data)
    {
        $car = $this->findById($id);
        $car->update($data);

        return $car;
    }
}