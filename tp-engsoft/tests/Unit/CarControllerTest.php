<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use App\Http\Controllers\CarController;
use App\Http\Requests\Car\CreateCarRequest;
use App\Http\Requests\Car\UpdateCarRequest;
use App\Services\CarService;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Mockery;

class CarControllerTest extends TestCase
{
    protected $carServiceMock;
    protected $carController;

    public function setUp(): void
    {
        parent::setUp();
        $this->carServiceMock = Mockery::mock(CarService::class);
        $this->carController = new CarController($this->carServiceMock);
    }

    public function testCreateCar()
    {
        $requestData = [
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => 2020,
        ];

        $requestMock = Mockery::mock(CreateCarRequest::class);
        $requestMock->shouldReceive('validated')->andReturn($requestData);

        $this->carServiceMock
            ->shouldReceive('create')
            ->once()
            ->with($requestData)
            ->andReturn(true);

        $response = $this->carController->createCar($requestMock);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function testUpdateCar()
    {
        $id = 1;
        $requestData = [
            'make' => 'Ford',
            'model' => 'Fusion',
            'year' => 2018,
        ];

        $requestMock = Mockery::mock(UpdateCarRequest::class);
        $requestMock->shouldReceive('validated')->andReturn($requestData);

        $this->carServiceMock
            ->shouldReceive('update')
            ->once()
            ->with($id, $requestData)
            ->andReturn(true);

        $response = $this->carController->updateCar($id, $requestMock);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testDeleteCar()
    {
        $id = 1;

        $this->carServiceMock
            ->shouldReceive('delete')
            ->once()
            ->with($id)
            ->andReturn(true);

        $response = $this->carController->deleteCar($id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetAllCars()
    {
        $cars = [
            ['make' => 'Toyota', 'model' => 'Camry', 'year' => 2020],
            ['make' => 'Ford', 'model' => 'Fusion', 'year' => 2018],
        ];

        $this->carServiceMock
            ->shouldReceive('getAll')
            ->once()
            ->andReturn($cars);

        $response = $this->carController->getAllCars();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
