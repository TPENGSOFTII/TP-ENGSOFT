<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;

class UserController extends BaseApiController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(CreateUserRequest $request)
    {
        $userData = $request->validated();
        return $this->handleCreate($userData, [$this->userService, 'createUser']);
    }

    public function updateUser($id, UpdateUserRequest $request)
    {
        $userData = $request->validated();
        return $this->handleUpdate($id, $userData, [$this->userService, 'updateUser']);
    }

    public function deleteUser($id)
    {
        return $this->handleDelete($id, [$this->userService, 'deleteUser'], 'Usuário');
    }
}