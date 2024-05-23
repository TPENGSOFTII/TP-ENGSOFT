<?php

namespace App\Repositories\Car;

use App\Models\Car;
use App\Exceptions\EntityNotFoundException;

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
        $car = Car::find($id);

        if (!$car) {
            throw new EntityNotFoundException('carro');
        }

        return $car;
    }

    public function update($id, $data)
    {
        $car = $this->findById($id);
        $car->update($data);

        return $car;
    }

    public function delete($id)
    {
        $car = $this->findById($id);
        $car->users()->detach();

        return $car->delete();
    }
}