<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Car\CarRepositoryInterface;

class UserCarService
{
    protected $userRepository;
    protected $carRepository;

    public function __construct(UserRepositoryInterface $userRepository, CarRepositoryInterface $carRepository)
    {
        $this->userRepository = $userRepository;
        $this->carRepository = $carRepository;
    }

    public function associateUserToCar($userId, $carId)
    {
        $user = $this->userRepository->findById($userId);
        $car = $this->carRepository->findById($carId);

        $user->cars()->attach($car);
    }
}
