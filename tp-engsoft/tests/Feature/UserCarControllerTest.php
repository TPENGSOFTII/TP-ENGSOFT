<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Car;

class UserCarControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAssociateUserToCar()
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $response = $this->post("/api/users/{$user->id}/cars/{$car->id}/associate");

        $response->assertStatus(200);

        $this->assertTrue($user->cars->contains($car->id));
    }

    public function testDisassociateUserFromCar()
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $user->cars()->attach($car);

        $response = $this->delete("/api/users/{$user->id}/cars/{$car->id}/disassociate");

        $response->assertStatus(200);

        $this->assertFalse($user->cars->contains($car->id));
    }

    public function testGetUserCars()
    {
        $user = User::factory()->create();

        $cars = Car::factory()->count(3)->create();
        $user->cars()->attach($cars);

        $response = $this->get("/api/users/{$user->id}/cars");

        $response->assertStatus(200);

        $response->assertJsonStructure(['data']);
    }
}
