<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'brand' => $this->faker->word,
            'model' => $this->faker->word,
            'license_plate' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'color' => $this->faker->colorName,
        ];
    }
}
