<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'birth_date',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = ['deleted_at'];

    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_user');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->password = Hash::make($user->password);
        });
    }
}
