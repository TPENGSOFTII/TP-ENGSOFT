<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'brand', 'model', 'license_plate', 'color',
    ];
    protected $dates = ['deleted_at'];
    public function users()
    {
        return $this->belongsToMany(Car::class, 'car_user');
    }
}


database/factories/CarFactory.php

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
