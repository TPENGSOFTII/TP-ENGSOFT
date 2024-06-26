<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Car\CarRepositoryInterface;

class UserCarService extends BaseService
{
    protected $carRepository;

    public function __construct(UserRepositoryInterface $userRepository, CarRepositoryInterface $carRepository)
    {
        parent::__construct($userRepository);
        $this->carRepository = $carRepository;
    }

    private function getUserAndCar($userId, $carId, &$user, &$car)
    {
        $user = $this->repository->findById($userId);
        $car = $this->carRepository->findById($carId);
    }

    public function associateUserToCar($userId, $carId)
    {
        $this->getUserAndCar($userId, $carId, $user, $car);
        $this->associateEntityToCar($user, $car);
    }

    public function disassociateUserFromCar($userId, $carId)
    {
        $this->getUserAndCar($userId, $carId, $user, $car);
        $this->dissociateEntityFromCar($user, $car);
    }

    public function getUserCars($userId)
    {
        $user = $this->findById($userId);
        return $this->getEntityCarsPaginated($user);
    }
}
