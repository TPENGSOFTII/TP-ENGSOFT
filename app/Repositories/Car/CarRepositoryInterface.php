<?php

namespace App\Repositories\Car;

interface CarRepositoryInterface
{
    public function create(array $data);
    public function getAll();
    public function update($id, array $data);
}
