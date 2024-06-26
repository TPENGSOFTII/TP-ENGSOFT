<?php

namespace App\Repositories\Base;

interface BaseRepositoryInterface
{
    public function create(array $data);
    public function findById($id);
    public function update($id, array $data);
    public function delete($id);
    public function getAll();
}
