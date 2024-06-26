<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;

class UserService extends BaseService
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct($userRepository);
    }
}
