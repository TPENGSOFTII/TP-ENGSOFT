<?php

namespace App\Http\Controllers;

use App\Services\UserCarService;
use Illuminate\Http\Request;

class UserCarController extends BaseApiController
{
    protected $userCarService;

    public function __construct(UserCarService $userCarService)
    {
        $this->userCarService = $userCarService;
    }

    public function associateUserToCar($userId, $carId, Request $request)
    {
        return $this->handleAssociationOrDisassociation($userId, $carId, [$this->userCarService, 'associateUserToCar'], true);
    }

    public function disassociateUserFromCar($userId, $carId)
    {
        return $this->handleAssociationOrDisassociation($userId, $carId, [$this->userCarService, 'disassociateUserFromCar'], false);
    }

    public function getUserCars($userId)
    {
        return $this->handleGetAll([$this->userCarService, 'getUserCars'], $userId);
    }
}