<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use App\Http\Controllers\UserCarController;
use App\Services\UserCarService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Mockery;

class UserCarControllerTest extends TestCase
{
    protected $userCarServiceMock;
    protected $userCarController;

    public function setUp(): void
    {
        parent::setUp();
        $this->userCarServiceMock = Mockery::mock(UserCarService::class);
        $this->userCarController = new UserCarController($this->userCarServiceMock);
    }

    public function testAssociateUserToCar()
    {
        $userId = 1;
        $carId = 1;

        $requestMock = Mockery::mock(Request::class);

        $this->userCarServiceMock
            ->shouldReceive('associateUserToCar')
            ->once()
            ->with($userId, $carId)
            ->andReturn(true);

        $response = $this->userCarController->associateUserToCar($userId, $carId, $requestMock);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testDisassociateUserFromCar()
    {
        $userId = 1;
        $carId = 1;

        $this->userCarServiceMock
            ->shouldReceive('disassociateUserFromCar')
            ->once()
            ->with($userId, $carId)
            ->andReturn(true);

        $response = $this->userCarController->disassociateUserFromCar($userId, $carId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testGetUserCars()
    {
        $userId = 1;
        $cars = [
            ['id' => 1, 'make' => 'Toyota', 'model' => 'Camry'],
            ['id' => 2, 'make' => 'Ford', 'model' => 'Fusion'],
        ];

        $this->userCarServiceMock
            ->shouldReceive('getUserCars')
            ->once()
            ->with($userId)
            ->andReturn($cars);

        $response = $this->userCarController->getUserCars($userId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testAssociateUserToCarAlreadyAssociated()
    {
        $userId = 1;
        $carId = 1;

        $requestMock = Mockery::mock(Request::class);

        $this->userCarServiceMock
            ->shouldReceive('associateUserToCar')
            ->once()
            ->with($userId, $carId)
            ->andReturn(false);

        $response = $this->userCarController->associateUserToCar($userId, $carId, $requestMock);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testGetUserCarsNoCars()
    {
        $userId = 1;

        $this->userCarServiceMock
            ->shouldReceive('getUserCars')
            ->once()
            ->with($userId)
            ->andReturn([]);
        $response = $this->userCarController->getUserCars($userId);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals([], $response->getData(true));
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
