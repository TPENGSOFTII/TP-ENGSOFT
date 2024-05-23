<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Exceptions\EntityNotFoundException;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return User::create($data);
    }

    public function findById($id)
    {
        $user = User::find($id);

        if (!$user) {
            throw new EntityNotFoundException('usuário');
        }

        return $user;
    }

    public function update($id, $data)
    {
        $user = $this->findById($id);
        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        $user->cars()->detach();

        return $user->delete();
    }
}
