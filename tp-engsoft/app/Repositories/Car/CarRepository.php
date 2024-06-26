<?php

namespace App\Repositories\Car;

use App\Models\Car;
use App\Repositories\Base\BaseRepository;

class CarRepository extends BaseRepository implements CarRepositoryInterface
{
    public function __construct(Car $car)
    {
        parent::__construct($car);
    }

    protected function getEntityName()
    {
        return 'carro';
    }
    
    protected function handleDeleteRelations($car)
    {
        $car->users()->detach();
    }
}
