<?php

namespace App\Repositories\Base;

use App\Exceptions\EntityNotFoundException;

abstract class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findById($id)
    {
        $entity = $this->model->find($id);

        if (!$entity) {
            throw new EntityNotFoundException($this->getEntityName());
        }

        return $entity;
    }

    public function update($id, $data)
    {
        $entity = $this->findById($id);
        $entity->update($data);

        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->findById($id);
        $this->handleDeleteRelations($entity);

        return $entity->delete();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    abstract protected function getEntityName();

    abstract protected function handleDeleteRelations($entity);
}
