<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Car;

class CarControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCar()
    {
        $carData = [
            'brand' => 'Toyota',
            'model' => 'Etios',
            'color' => 'Prata',
            'license_plate' => 'ABC123',
        ];

        $response = $this->post('/api/cars', $carData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('cars', ['license_plate' => 'ABC123']);
    }

    public function testGetAllCars()
    {
        Car::factory()->count(3)->create();

        $response = $this->get('/api/cars');

        $response->assertStatus(200);
        $response->assertJsonStructure(['*' => ['id', 'brand', 'model', 'color', 'license_plate']]);
    }

    public function testUpdateCar()
    {
        $car = Car::factory()->create();

        $updatedData = [
            'brand' => 'Fiat',
            'model' => 'Argo',
            'color' => 'Vermelho',
            'license_plate' => 'XYZ789',
        ];

        $response = $this->put("/api/cars/{$car->id}", $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('cars', ['id' => $car->id, 'license_plate' => 'XYZ789']);
    }

    public function testDeleteCar()
    {
        $car = Car::factory()->create();

        $response = $this->delete("/api/cars/{$car->id}");

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Carro deletado com sucesso.']);
    }

}
