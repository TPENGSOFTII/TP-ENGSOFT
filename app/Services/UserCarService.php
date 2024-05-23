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
    private function getUserAndCar($userId, $carId, &$user, &$car)
    {
        $user = $this->userRepository->findById($userId);
        $car = $this->carRepository->findById($carId);
    }

    public function associateUserToCar($userId, $carId)
    {
        $this->getUserAndCar($userId, $carId, $user, $car);

        $user->cars()->attach($car);
    }

    public function disassociateUserFromCar($userId, $carId)
    {
        $this->getUserAndCar($userId, $carId, $user, $car);

        $user->cars()->detach($car);
    }

    public function getUserCars($userId)
    {
        $user = $this->userRepository->findById($userId);

        return $user->cars()->paginate();
    }
}
