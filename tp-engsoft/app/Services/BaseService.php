<?php

namespace App\Services;

use App\Repositories\Base\BaseRepositoryInterface;

abstract class BaseService
{
    protected $repository;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function associateEntityToCar($entity, $car)
    {
        $entity->cars()->attach($car);
    }

    public function dissociateEntityFromCar($entity, $car)
    {
        $entity->cars()->detach($car);
    }

    public function getEntityCarsPaginated($entity)
    {
        return $entity->cars()->paginate();
    }
}
