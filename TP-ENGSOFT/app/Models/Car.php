<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'brand', 'model', 'license_plate', 'color',
    ];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(Car::class, 'car_user');
    }
}
