<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testCreateUser()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password123',
            'birth_date' => '2023-01-01',
        ];

        $response = $this->post('/api/users', $userData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'test@test.com']);
    }

    public function testUpdateUser()
    {
        $user = User::factory()->create();

        $updatedData = [
            'name' => 'Updated User',
            'email' => 'updated@updated.com',
        ];

        $response = $this->put("/api/users/{$user->id}", $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'email' => 'updated@updated.com']);
    }

    public function testDeleteUser()
    {
        $user = User::factory()->create();

        $response = $this->delete("/api/users/{$user->id}");

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Usuário deletado com sucesso.']);
    }

}
